<?php

if ( ! function_exists( 'biagiotti_mikado_add_product_exhibition_shortcode' ) ) {
	function biagiotti_mikado_add_product_exhibition_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'BiagiottiCore\CPT\Shortcodes\ProductExhibition\ProductExhibition',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'biagiotti_core_filter_add_vc_shortcode', 'biagiotti_mikado_add_product_exhibition_shortcode' );
}

if ( ! function_exists( 'biagiotti_mikado_set_product_exhibition_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for product exhibition shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function biagiotti_mikado_set_product_exhibition_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-product-exhibition';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'biagiotti_core_filter_add_vc_shortcodes_custom_icon_class', 'biagiotti_mikado_set_product_exhibition_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'biagiotti_mikado_add_product_exhibition_into_shortcodes_list' ) ) {
	function biagiotti_mikado_add_product_exhibition_into_shortcodes_list( $woocommerce_shortcodes ) {
		$woocommerce_shortcodes[] = 'mkdf_product_exhibition';
		
		return $woocommerce_shortcodes;
	}
	
	add_filter( 'biagiotti_mikado_filter_woocommerce_shortcodes_list', 'biagiotti_mikado_add_product_exhibition_into_shortcodes_list' );
}

if ( ! function_exists( 'biagiotti_mikado_get_product_list_html' ) ) {
	/**
	 * Calls product list shortcode with given parameters and returns it's output
	 *
	 * @param $params
	 *
	 * @return mixed|string
	 */
	function biagiotti_mikado_get_product_list_html( $params ) {
		$product_list_html = biagiotti_mikado_execute_shortcode( 'mkdf_product_list', $params );
		$product_list_html = str_replace( "\n", '', $product_list_html );

		return $product_list_html;
	}
}