<?php

if ( ! function_exists( 'biagiotti_mikado_woocommerce_wishlist_shortcode' ) ) {
	function biagiotti_mikado_woocommerce_wishlist_shortcode() {
        exit('test1');
        if ( ! is_post_type_archive( 'product' ) && ! is_product_taxonomy() ) {
            return;
        }
		if ( biagiotti_mikado_is_yith_wcwl_installed()  ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
	}
}

if ( ! function_exists( 'biagiotti_mikado_product_ajax_wishlist' ) ) {
	function biagiotti_mikado_product_ajax_wishlist() {
		check_ajax_referer( 'mkdf_themename_product_wishlist_nonce_' . sanitize_text_field( $_POST['product_wishlist_id'] ), 'product_wishlist_nonce' );
		
		$data = array(
			'wishlist_count_products' => class_exists( 'YITH_WCWL' ) ? yith_wcwl_count_products() : 0
		);
		
		wp_send_json( $data );
		
		exit;
	}
	
	add_action( 'wp_ajax_biagiotti_mikado_product_ajax_wishlist', 'biagiotti_mikado_product_ajax_wishlist' );
	add_action( 'wp_ajax_nopriv_biagiotti_mikado_product_ajax_wishlist', 'biagiotti_mikado_product_ajax_wishlist' );
}

if ( ! function_exists( 'biagiotti_mikado_register_yith_wishlist_widget' ) ) {
	/**
	 * Function that register yith wishlist widget
	 */
	function biagiotti_mikado_register_yith_wishlist_widget( $widgets ) {
		$widgets[] = 'BiagiottiCoreClassYithWishlist';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_yith_wishlist_widget' );
}