<?php

function weex_import_categories_page() {
    echo '<div class="wrap"><h1>Імпорт категорій WEEX</h1>';

    if (!empty($_FILES['csv_file']['tmp_name'])) {
        $csv_path = $_FILES['csv_file']['tmp_name'];
        // Тут можна викликати функцію обробки CSV-файлу
        import_category_from_csv($csv_path);

        echo '<div class="notice notice-success"><p>CSV-файл успішно імпортовано!</p></div>';
    }

    echo '
    <form method="post" enctype="multipart/form-data">
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

function import_category_from_csv($csv_file) {
    if (!file_exists($csv_file)) {
        echo '<div class="notice notice-error"><p>CSV файл не знайдено!</p></div>';
        return;
    }

    $csv = array_map('str_getcsv', file($csv_file));
    $header = array_map('trim', array_shift($csv));
    $translations = [];

    foreach ($csv as $row) {
        $data = array_combine($header, $row);
        $name = trim($data['name']);
        $title = trim($data['title']);

        $slug = sanitize_title($data['slug']);
        $language = trim($data['language']);
        $group_id = trim($data['translation_group']);

        $parent_name = isset($data['parent']) ? trim($data['parent']) : '';


        $parent_id = 0;

        if ($parent_name) {
            $parent_terms = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false, 'slug' => $parent_name]);

            foreach ($parent_terms as $term) {
                $languages = pll_get_term_translations($term->term_id);
                if (array_key_exists($language, $languages)) {
                    $parent_id = $term->term_id;
                    break;
                }
            }

        }

        // Створення терміна (якщо ще не існує)
        $term = get_term_by('slug', $slug, 'product_cat');

        if (!$term) {
            $term = wp_insert_term($title, 'product_cat', [
                'slug' => $slug,
                'parent' => $parent_id,
            ]);
            if (is_wp_error($term)) {
                continue;
            }
            $term_id = $term['term_id'];
            update_term_meta($term_id, 'folder_name', $name);
            update_term_meta($term_id, 'translation_group', $group_id);
            update_term_meta($term_id, 'language', $language);
        } else {
            $term_id = $term->term_id;
        }

        // Встановлення мови (після створення, але до збереження перекладів)
        if (function_exists('pll_set_term_language')) {
            pll_set_term_language($term_id, $language);
        }

        // Додаємо в масив для перекладів
        $translations[$group_id][$language] = $term_id;
    }

    cleanup_category_translation($translations);
}

function cleanup_category_translation(array $translations)
{
    $default_lang = function_exists('pll_default_language') ? pll_default_language () : 'ua';

    global $wpdb;
    foreach ($translations as $group) {


        $langs_for_clean_up = array_filter(array_keys($group), function ($code) use ($default_lang) {
            return $code !== $default_lang;
        });

        $default_lang_id = $group[$default_lang];
        $transl_meta_id = $wpdb->get_var("SELECT term_id FROM {$wpdb->term_taxonomy} WHERE description like '%i:{$default_lang_id};%' LIMIT 1");

        //cut up additional information about languages
        foreach ($langs_for_clean_up as $code) {
            $meta_id = $group[$code];

            //get term_translations
            $sql = "SELECT term_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'term_translations' AND description like '%i:{$meta_id};%'";
            $term_pll_ids_raw = $wpdb->get_results($sql);
            $term_pll_ids = wp_list_pluck($term_pll_ids_raw, 'term_id');

            $placeholders = implode(',', array_fill(0, count($term_pll_ids), '%d'));
            $sql = "DELETE FROM {$wpdb->term_taxonomy} WHERE term_id IN ($placeholders)";
            $wpdb->query($wpdb->prepare($sql, ...$term_pll_ids));
            $sql = "DELETE FROM {$wpdb->terms} WHERE term_id IN ($placeholders)";
            $wpdb->query($wpdb->prepare($sql, ...$term_pll_ids));

            //changing relationship
            foreach ($term_pll_ids as $term_pll_id) {
                $wpdb->update($wpdb->term_relationships, ['term_taxonomy_id' => $transl_meta_id], ['object_id' => $group[$code], 'term_taxonomy_id' => $term_pll_id]);
            }
        }

        $pattern = '%' . $wpdb->esc_like("i:{$default_lang_id};") . '%';

        $sql = "DELETE FROM {$wpdb->term_taxonomy} WHERE term_id <> %d AND description LIKE %s";
        $prepared = $wpdb->prepare($sql, $transl_meta_id, $pattern);

        $wpdb->query($prepared);

        $wpdb->update($wpdb->term_taxonomy, ['description' => serialize($group)], ['term_id' => $transl_meta_id]);
    }
}