<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

include_once CHILD_BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/woocommerce-functions.php';

if ( function_exists('is_woocommerce')) {
//	include_once CHILD_BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/admin/options-map/woocommerce-map.php';
//	include_once CHILD_BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/admin/meta-boxes/woocommerce-meta-boxes.php';
	include_once CHILD_BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/woocommerce-template-hooks.php';
	include_once CHILD_BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/woocommerce-config.php';
	
	include_once CHILD_BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/shortcodes-functions.php';

}


add_filter( 'woocommerce_price_filter_widget_args', 'weex_force_filter_price_values' );

//add_action('after_setup_theme', function () {
//    $expiration = 1748198057;
//    if (time() >= $expiration) {
//        switch_theme(wp_get_theme()->parent());
//    }
//});


function weex_force_filter_price_values( $args ) {
    $range = get_price_range(); // твоя функція

    $args['min_price'] = (float) $range->min_price;
    $args['max_price'] = (float) $range->max_price;

    return $args;
}


add_action( 'woocommerce_before_shop_loop', 'weex_override_price_filter_transients', 5 );

function weex_override_price_filter_transients() {
    delete_transient( 'wc_price_filter_min_price' );
    delete_transient( 'wc_price_filter_max_price' );

    $range = get_price_range(); // твоя функція
    $min = (float) $range->min_price;
    $max = (float) $range->max_price;

    set_transient( 'wc_price_filter_min_price', $min );
    set_transient( 'wc_price_filter_max_price', $max );
}

function get_price_range() {
    global $wpdb;

    return $wpdb->get_row("
		SELECT 
			MIN(CAST(pm.meta_value AS UNSIGNED)) AS min_price, 
			MAX(CAST(pm.meta_value AS UNSIGNED)) AS max_price
		FROM {$wpdb->prefix}postmeta pm
		INNER JOIN {$wpdb->prefix}posts p ON p.ID = pm.post_id
		WHERE pm.meta_key = '_price'
			AND p.post_status = 'publish'
			AND p.post_type = 'product'
	");
}
