<?php

function weex_import_images_page(): void
{
    echo '<div class="wrap"><h1>Імпорт зображень WEEX</h1>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['weex_import'])) {
        if (!empty($_FILES['csv_file']['tmp_name'])) {
            $csv_path = $_FILES['csv_file']['tmp_name'];
            $base_dir = sanitize_text_field($_POST['base_image_dir']);
            $additional_dir = sanitize_text_field($_POST['aditional_image_dir']);

            get_product_information_from_csv($csv_path, $base_dir, $additional_dir);

            echo '<div class="notice notice-success"><p>CSV-файл успішно імпортовано!</p></div>';
        }
    }

    echo '
    <form method="post" enctype="multipart/form-data">
        <table class="form-table">
            <tr>
                <th><label for="csv_file">CSV-файл товарів</label></th>
                <td><input type="file" name="csv_file" id="csv_file" accept=".csv" required></td>
            </tr>
            <tr>
                <th><label for="base_image_dir">Шлях до теки головних зображень</label></th>
                <td><input type="text" name="base_image_dir" id="base_image_dir" value="/home/weex2/weexnail.com/www/Карточки товара для сайта" required></td>
            </tr>
            <tr>
                <th><label for="aditional_image_dir">Шлях до теки додаткових зображень</label></th>
                <td><input type="text" name="aditional_image_dir" id="aditional_image_dir" value="/home/weex2/weexnail.com/www/Weex на ногтях. Допфото" required></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="weex_import" class="button button-primary" value="Імпортувати CSV">
        </p>
    </form></div>';
}

function get_product_information_from_csv(string $csv_file, string $base_images_dir, string $additional_images_dir): void
{
    if (!file_exists($csv_file)) {
        echo '<div class="notice notice-error"><p>CSV файл не знайдено!</p></div>';
        return;
    }

    if (!function_exists('read_csv')) {
        echo '<div class="notice notice-error"><p>Функція read_csv не знайдена.</p></div>';
        return;
    }

    $csv = read_csv($csv_file);

    $attached_product_ids = get_attached_products();

    foreach ($csv as $row) {

        $sku = $row ["Артикул"];

        $product_ids =
            array_diff(get_product_ids_by_sku($sku), $attached_product_ids);

        if (count($product_ids) === 0) {
            continue;
        }


        $product_name = $row["Назва товару"] ?? '';
        $image_name = $row['image'] ?? '';

        if (empty($product_name) || empty($image_name)) {
            continue;
        }

        $fullImagePath = findFilePath($base_images_dir, $image_name, $product_name);
        if (!$fullImagePath) {
            continue;
        }

        $relative_dir = trim(str_replace([$image_name, $base_images_dir], '', $fullImagePath), "/");
        $search_dir = $additional_images_dir . '/' . $relative_dir;

        if (!file_exists($search_dir)) {
            continue;
        }

        $images = find_additional_images($search_dir, $product_name);

        attach_images_to_product($product_ids, $images);
    }
}

function get_attached_products(): array
{
    global $wpdb;

    $find = $wpdb->prepare("SELECT post_id from $wpdb->postmeta WHERE meta_key = '_product_image_gallery'");

    return $wpdb->get_col($find);
}

function find_additional_images(string $directory, string $product_name): array
{
    $images = [];
    $items = scandir($directory);

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $item_path = $directory . '/' . $item;

        if (is_dir($item_path) && (strpos(strtolower($product_name), strtolower($item)) !== false ||
                strpos(strtolower($item), strtolower($product_name)) !== false)) {

            foreach (scandir($item_path) as $file) {
                if (!is_allowed_file_type($item_path . '/' . $file)) {
                    continue;
                }
                if ($file !== '.' && $file !== '..') {
                    $images[] = $item_path . '/' . $file;
                }
            }
        }
    }

    return $images;
}

function findFilePath(string $directory, string $filename, string $productname): ?string
{
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $fileInfo) {
        if ($fileInfo->isFile() && $fileInfo->getFilename() === $filename) {
            return $fileInfo->getPathname();
        }
    }

    return null;
}

function attach_images_to_product(array $product_ids, array $image_paths): void
{
    if (count($image_paths) === 0) {
        return;
    }

    if (empty($product_ids)) {
        error_log("❌ Товар не знайдено.");
        return;
    }

    foreach ($product_ids as $product_id) {
        $gallery_ids = [];

        foreach ($image_paths as $image_path) {
            if (!file_exists($image_path)) {
                error_log("⚠️ Файл не знайдено: $image_path");
                continue;
            }

            // ✅ Перевірка типу
            if (!is_allowed_file_type($image_path)) {
                continue;
            }

            $hash = md5_file($image_path);

            // Перевірка, чи вже є файл з таким хешем
            $existing = get_posts([
                'post_type'  => 'attachment',
                'meta_key'   => '_file_md5',
                'meta_value' => $hash,
                'posts_per_page' => 1,
                'fields' => 'ids'
            ]);

            if (!empty($existing)) {
                $attachment_id = $existing[0];
                error_log("ℹ️ Файл уже існує (ID: $attachment_id)");
            } else {
                // Завантаження нового зображення
                $attachment_id = attach_local_image_to_product($product_id, $image_path);
                if ($attachment_id) {
                    update_post_meta($attachment_id, '_file_md5', $hash);
                    error_log("✅ Завантажено нове зображення (ID: $attachment_id)");
                }
            }

            if (!empty($attachment_id) && !is_wp_error($attachment_id)) {
                $gallery_ids[] = $attachment_id;
            }
        }

        if (!empty($gallery_ids)) {
            $current_gallery = get_post_meta($product_id, '_product_image_gallery', true);
            $current_ids = $current_gallery ? explode(',', $current_gallery) : [];

            $new_gallery = array_unique(array_merge($current_ids, $gallery_ids));

            update_post_meta($product_id, '_product_image_gallery', implode(',', $new_gallery));

            error_log("🖼 Додано " . count($gallery_ids) . " зображень до товару ID $product_id (SKU: $sku)");
        }
    }
}

function is_allowed_file_type($image_path): bool
{
    $filetype = wp_check_filetype($image_path);
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if (!in_array($filetype['type'], $allowed_types, true)) {
        error_log("❌ Пропущено: $image_path — не зображення ({$filetype['type']})");
        return false;
    }

    return true;
}

function attach_local_image_to_product(int $product_id, string $local_path): ?int
{
    if (!file_exists($local_path)) {
        return null;
    }

    $filename = basename($local_path);
    $upload_dir = wp_upload_dir();

    // Копіюємо файл у папку з медіа WordPress
    $target_path = $upload_dir['path'] . '/' . $filename;

    if (!@copy($local_path, $target_path)) {
        return null;
    }

    $filetype = wp_check_filetype($filename, null);

    $attachment = [
        'post_mime_type' => $filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit'
    ];

    $attach_id = wp_insert_attachment($attachment, $target_path, $product_id);
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $attach_data = wp_generate_attachment_metadata($attach_id, $target_path);
    wp_update_attachment_metadata($attach_id, $attach_data);

    return $attach_id;
}

function get_product_ids_by_sku(string $sku): array
{
    global $wpdb;
    $query = $wpdb->prepare("SELECT post_id as product_id 
        FROM $wpdb->postmeta WHERE meta_key = '_sku' AND meta_value= %s", $sku);

    return (array) $wpdb->get_col( $query );
}
