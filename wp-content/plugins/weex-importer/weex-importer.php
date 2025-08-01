<?php
/**
 * Plugin Name: WEEX Importer
 * Description: Імпортує створює категорії та товари, додає мультимовність, зображення, опис до товарів
 * Version: 1.1
 * Author: tavisua
 */

require_once plugin_dir_path(__FILE__) . 'category-importer.php';
require_once plugin_dir_path(__FILE__) . 'product-importer.php';
require_once plugin_dir_path(__FILE__) . 'image-importer.php';

add_action('admin_menu', function () {
    // Головне меню: Імпорт WEEX
//    add_menu_page(
//        'Імпорт WEEX',       // Page title
//        'Імпорт WEEX',       // Menu title
//        'manage_options',    // Capability
//        'weex-import-main',  // Menu slug
//        '',                  // Callback, лишаємо пустим бо підменю буде активне
//        'dashicons-upload',  // Icon
//        56                   // Position (опціонально)
//    );

    // Підменю: Імпорт товарів
    add_submenu_page(
        'woocommerce',
        'Імпорт товарів WEEX',   // Page title
        'Імпорт товарів WEEX',   // Menu title
        'manage_options',     // Capability
        'weex-import-products', // Menu slug
        'weex_import_products_page'  // Callback
    );
    // Підменю: Оновлення описів товарів
    add_submenu_page(
        'woocommerce',
        'Оновити описи товарів WEEX',   // Page title
        'Оновити описи товарів WEEX',   // Menu title
        'manage_options',     // Capability
        'weex-update-products-description', // Menu slug
        'update_products_descriptions_from_csv'  // Callback
    );

    // Підменю: Імпорт категорій
    add_submenu_page(
        'woocommerce',   // Parent slug
        'Імпорт категорій WEEX',   // Page title
        'Імпорт категорій WEEX',   // Menu title
        'manage_options',
        'weex-import-categories',
        'weex_import_categories_page' // Новий callback
    );

    // Підменю: Імпорт категорій
    add_submenu_page(
        'woocommerce',   // Parent slug
        'Імпорт додаткових зображень WEEX',   // Page title
        'Імпорт додаткових зображень WEEX',   // Menu title
        'manage_options',
        'weex-import-images',
        'weex_import_images_page' // Новий callback
    );
});

