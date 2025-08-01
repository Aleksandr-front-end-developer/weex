<?php

if ( ! function_exists( 'biagiotti_mikado_woocommerce_yith_wishlist_init' ) ) {
	function biagiotti_mikado_woocommerce_yith_wishlist_init() {
		//Changde quci
		if ( class_exists('YITH_WCQV_Frontend') ) {
			remove_action('woocommerce_after_shop_loop_item', array(YITH_WCQV_Frontend(), 'yith_add_quick_view_button'), 15);
			add_action('biagiotti_mikado_action_woo_pl_info_on_image_hover', array(YITH_WCQV_Frontend(), 'yith_add_quick_view_button'), 14);
			add_action('biagiotti_mikado_action_woo_pl_info_below_image', array(YITH_WCQV_Frontend(), 'yith_add_quick_view_button'), 3);
			add_action('biagiotti_mikado_action_product_list_shortcode', array(YITH_WCQV_Frontend(), 'yith_add_quick_view_button'), 3);
		}
		//Override product title
		remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_title', 5 );
		add_action( 'yith_wcqv_product_summary', 'biagiotti_mikado_woocommerce_yith_template_single_title', 5 );

		//Remove default actions for product image and add custom
		remove_action( 'yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );

		//Remove product meta
		remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );

		//Add wishlist button
		add_action( 'yith_wcqv_product_summary', 'biagiotti_mikado_woocommerce_wishlist_shortcode', 31 );

		//Change rating star position
		remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_rating', 15 );
	}

	add_action( 'init', 'biagiotti_mikado_woocommerce_yith_wishlist_init', 15 );
}