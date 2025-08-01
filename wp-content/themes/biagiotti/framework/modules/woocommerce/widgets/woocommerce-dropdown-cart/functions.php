<?php

if ( ! function_exists( 'biagiotti_mikado_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function biagiotti_mikado_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'biagiotti_mikado_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function biagiotti_mikado_get_dropdown_cart_icon_class() {
		$classes = array(
			'mkdf-header-cart'
		);
		
		$classes[] = biagiotti_mikado_get_icon_sources_class( 'dropdown_cart', 'mkdf-header-cart' );
		
		return implode( ' ', $classes );
	}
}