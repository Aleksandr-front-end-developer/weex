<?php

function update_products_descriptions_from_csv(): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['weex_import'])) {
        $csv_path = $_FILES['csv_file']['tmp_name'];
        if (!file_exists($csv_path)) {
            exit('CSV-файл не знайдено!');
        }

        $file = fopen($csv_path, 'r');

        $header = fgetcsv($file);
        $columns = array_flip($header);

        echo '<pre>';
        while (($row = fgetcsv($file)) !== false) {
            $sku = $row[$columns['Артикул']];
//            $language = $row[$columns['language']];
            $short_description = $row[$columns['short_description']];
            $description = $row[$columns['description']];

            global $wpdb;

//            if ($language != 'uk') {
//                $short_description = '';
//                $description = '';
//            }

            // Отримуємо ID товарів за SKU
            $product_ids = $wpdb->get_col($wpdb->prepare(
                "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_sku' AND meta_value = %s",
                $sku
            ));

            if (empty($product_ids)) {
                echo "Товар з SKU {$sku} не знайдено. Пропускаємо.\n";
                continue;
            }

            foreach ($product_ids as $product_id) {
                // Перевірка мови для Polylang
                if (function_exists('pll_get_post_language')) {
                    $post_language = pll_get_post_language($product_id);
                    if ($post_language !== 'uk') {
                        $short_description = '';
                        $description = '';
                    }
                }

                // Оновлюємо опис товару
                wp_update_post([
                    'ID' => $product_id,
                    'post_excerpt' => $short_description,
                    'post_content' => $description,
                ]);

                echo "Опис товару SKU {$sku} успішно оновлено.\n";
            }
        }

        fclose($file);
    }
    echo '
    <form method="post" enctype="multipart/form-data">
        ' . wp_nonce_field("weex_update_description_action") . '
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="csv_file">CSV-файл</label></th>
                <td><input type="file" name="csv_file" id="csv_file" accept=".csv" required></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="weex_import" class="button button-primary" value="Імпортувати CSV">
        </p>
    </form></div>';
}

function weex_import_products_page(): void {
    echo '<div class="wrap"><h1>Імпорт товарів WEEX</h1>';
//    echo '<pre>';
//    var_dump(scandir('/home/weex2/weexnail.com/www/Карточки товара для сайта'));
//    exit();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['weex_import'])) {

        $images = mapImagesFromDirectory($_POST["image_dir"]);

        foreach ($images as $key => $image) {
            $category = getFolderNameFromImagePath($image);

            $terms = get_terms([
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'meta_query' => [
                    'relation' => 'AND',
                    [
                        'key' => 'folder_name',
                        'value' => $category,
                        'compare' => '=',
                    ],
                    [
                        'key' => 'language',
                        'value' => pll_default_language(),
                        'compare' => '=',
                    ],
                ],
            ]);

            if (count($terms) === 0) {
                continue;
            }

            $term = $terms[0];

            $imgPath = $images[$key];
            unset($images[$key]);

            $images[$key]['path'] = $imgPath;
            $images[$key]['category_id'] = $term->term_id;
        }

        if (!empty($_FILES['csv_file']['tmp_name'])) {
            $csv_path = $_FILES['csv_file']['tmp_name'];

            // Тут можна викликати функцію обробки CSV-файлу
            importProductsFromCsv($csv_path, $images);

            echo '<div class="notice notice-success"><p>CSV-файл успішно імпортовано!</p></div>';
        }
    }

    echo '
    <form method="post" enctype="multipart/form-data">
        ' . wp_nonce_field("weex_import_action") . '
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="csv_file">CSV-файл</label></th>
                <td><input type="file" name="csv_file" id="csv_file" accept=".csv" required></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="image_dir">Шлях до теки зображень</label></th>
                <td><input type="text" name="image_dir" id="image_dir" value="/home/weex2/weexnail.com/www/Карточки товара для сайта" required></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="weex_import" class="button button-primary" value="Імпортувати CSV">
        </p>
    </form></div>';
}


function getFolderNameFromImagePath(string $fullPath): string {
    // Нормалізуємо слеші
    $normalizedPath = str_replace('\\', '/', $fullPath);

    // Відкидаємо сам файл
    $folderPath = dirname($normalizedPath);

    // Розбиваємо по /
    $parts = explode('/', $folderPath);

    // Повертаємо останню непорожню частину
    return end($parts);
}


function upload_image_to_media_library(string $image_path, int $product_id = 0) {
    if (!file_exists($image_path)) {
        return new WP_Error('file_missing', 'Файл не знайдено: ' . $image_path);
    }

    $file_array = [
        'name'     => basename($image_path),
        'tmp_name' => $image_path,
    ];

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    // Завантажити файл у медіа-бібліотеку
    return media_handle_sideload($file_array, $product_id);
}

function mapImagesFromDirectory($base_path): array {
    $files = [];

    try {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($base_path)
        );
    } catch (Exception $e) {
        exit($e->getMessage());
    }



    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $filename = $file->getFilename();
            $files[$filename] = $file->getPathname(); // повний шлях до файлу
        }
    }

    return $files;
}

function importProductsFromCsv($csv_file, $images): void {

//    delete_products_modified_after('2025-04-27');
//    exit();


    if (!file_exists($csv_file)) {
        echo '<div class="notice notice-error"><p>CSV файл не знайдено!</p></div>';
        return;
    }

    $csv = read_csv($csv_file);

    if (count($csv) <= 1) {
        echo '<div class="notice notice-error"><p>Товарів не знайдено!</p></div>';
        return;
    }

    $translateGroups = [];
    $translations = [];

    foreach ($csv as $row) {
        $translateGroups[$row['translation_group']][] = $row;
    }


    foreach ($translateGroups as $group) {
        foreach ($group as $row) {

            $sku = $row['Артикул'] ?? "";
            $name = trim($row['Назва товару']) ?? "";
            $slug = sanitize_title($row['slug']) ?? "";
            $language = trim($row['language']) ?? "";
            $translGroupId = trim($row['translate_group']) ?? "";
            $vyd = trim($row['Вид']) ?? "";
            $baseType = trim($row['Тип бази']) ?? "";
            $texture = trim($row['Текстура']) ?? "";
            $topType = trim($row['Вид топа']) ?? "";
            $value = trim($row['Об\'єм, мл']) ?? "";
            $color = trim($row['Колір']) ?? "";
            $price = trim($row['Ціна']) ?? "";
            $nickeName = trim($row['nick_name']) ?? "";

            $image = $images[$row['image']] ?? [];

            $imgFileName = $row['image'] ?? '';

            $shortDescription = trim($row['short_description']) ?? "";
            $description = trim($row['description']) ?? "";
            $defLangCatId = $image['category_id'] ?? '';

            if (empty($defLangCatId)) {
                continue;
            }
//gel-polish-weex-501.jpg
            $categoryId = pll_get_term_translations($defLangCatId)[$language];

            $imagePath = $image['path'] ?? '';

            $query = new WC_Product_Query([
                'meta_key' => '_sku',
                'meta_value' => $sku,
            ]);

            $products = $query->get_products();

            $args = ['sku' => $sku,
                'name' => $name,
                'slug' => $slug,
                'language' => $language,
                'translate_group' => $translGroupId,
                'vyd' => $vyd,
                'vyd_bazy' => $baseType,
                'texture' => $texture,
                'vyd_topy' => $topType,
                'obem-ml' => $value,
                'kolir' => $color,
                'price' => $price,
                'nick_name' => $nickeName,
                'image_path' => $imagePath,
                'image_file_name' => $imgFileName,
                'category_id' => $categoryId,
                'short_description' => $shortDescription,
                'description' => $description,
            ];

            if (count($products) == 0) {
                $productId = createProduct($args);
                $translations[$translGroupId][$language] = $productId;

                $lng = pll_get_post_language($productId);

            }
        }
    }
    foreach ($translations as $groupId => $translation) {
        pll_save_post_translations($translation);
    }


//    cleanup_product_translation($translations);
}

function createProduct($data): int
{
    $postData = [
        'post_title' => $data['name'],
        'post_name' => $data['slug'],
        'post_content' => $data['description'] ?? '',
        'post_excerpt' => $data['short_description'] ?? '',
        'post_status' => 'publish',
        'post_type' => 'product',
    ];

    $productId = wp_insert_post($postData);

    if (is_wp_error($productId)) {
        return $productId;
    }


    pll_set_post_language($productId, $data['language']);

    // SKU
    if (!empty($data['sku'])) {
        update_post_meta($productId, '_sku', $data['sku']);
    }

    // Ціна
    if (!empty($data['price'])) {
        update_post_meta($productId, '_regular_price', $data['price']);
        update_post_meta($productId, '_price', $data['price']);
    }

    // Категорія
    if (!empty($data['category_id'])) {
        wp_set_post_terms($productId, [(int)$data['category_id']], 'product_cat');
    }


    $attributes_to_check = [
        'vyd' => 'pa_vyd',
        'vyd_bazy' => 'pa_vyd_bazy',
        'vyd_topy' => 'pa_vyd_topy',
        'kolir' => 'pa_kolir',
        'obem-ml' => 'pa_obem-ml',
        'texture' => 'pa_texture',
        'nick_name' => 'pa_nick_name',
    ];

    $product_attributes = [];

    foreach ($attributes_to_check as $field_key => $taxonomy) {

        if (!empty($data[$field_key])) {
            $term_id = ensure_attribute_term_exists($taxonomy, $data[$field_key]);
            if ($term_id) {
                wp_set_object_terms($productId, [$data[$field_key]], $taxonomy, true);
                $product_attributes[$taxonomy] = [
                    'name'         => $taxonomy,
                    'value'        => '',
                    'is_visible'   => 1,
                    'is_variation' => 0,
                    'is_taxonomy'  => 1,
                ];
            }
        }
    }

    if (!empty($product_attributes)) {
        update_post_meta($productId, '_product_attributes', $product_attributes);
    }

    $imageId = getAttachmentIdByFilename($data['image_file_name']);

    if (!is_wp_error($imageId) && empty($imageId)) {
        $imageId = upload_image_to_media_library($data['image_path'], $productId);
    }

    // Зображення
    if (!is_wp_error($imageId)) {
        set_post_thumbnail($productId, $imageId);
    }

    return $productId;
}

function read_csv($csv_file): array {
    $rows = [];

    if (($handle = fopen($csv_file, 'r')) !== false) {
        // Зчитуємо заголовок
        $header = fgetcsv($handle, 0, ",", '"');
        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]); // видаляємо BOM, якщо є

        while (($row = fgetcsv($handle, 0, ",", '"')) !== false) {
            if (count($row) !== count($header)) {
                error_log("⛔ Невірна кількість колонок у рядку: " . json_encode($row));
                continue;
            }

            $rows[] = array_combine($header, $row);
        }

        fclose($handle);
    }

    return $rows;
}

function delete_products_modified_after($date_string) {
    $args = [
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'post_status'    => 'any', // Враховувати навіть чернетки
        'date_query'     => [
            [
                'after' => $date_string, // Дата у форматі 'YYYY-MM-DD'
                'column' => 'post_modified',
                'inclusive' => true,
            ],
        ],
        'fields' => 'ids', // Тільки ID, без об'єктів
    ];

    $query = new WP_Query($args);

    if (!empty($query->posts)) {
        foreach ($query->posts as $post_id) {
            wp_delete_post($post_id, true); // Справжнє видалення без переміщення в кошик
        }
    }
}

function getAttachmentIdByFilename(string $filename): ?int
{
    $args = [
        'post_type'      => 'attachment',
        'posts_per_page' => 1,
        'post_status'    => 'inherit',
        'meta_query'     => [
            [
                'key'     => '_wp_attached_file',
                'value'   => $filename,
                'compare' => 'LIKE'
            ]
        ]
    ];

    $attachments = get_posts($args);

    return !empty($attachments) ? $attachments[0]->ID : null;
}

function ensure_attribute_term_exists($taxonomy_slug, $term_name) {
    if (empty($term_name)) {
        return null;
    }

    if (!taxonomy_exists($taxonomy_slug)) {
        return null;
    }

    $term = term_exists($term_name, $taxonomy_slug);

    if (!$term) {
        $term = wp_insert_term(
            $term_name,
            $taxonomy_slug,
            ['slug' => sanitize_title($term_name)]
        );
    }

    if (is_wp_error($term)) {
        return null;
    }

    return is_array($term) ? $term['term_id'] : $term;
}

