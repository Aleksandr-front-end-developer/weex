<?php

if ( ! function_exists( 'biagiotti_mikado_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function biagiotti_mikado_dropdown_cart_icon_styles() {
		$icon_color       = biagiotti_mikado_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = biagiotti_mikado_options()->getOptionValue( 'dropdown_cart_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo biagiotti_mikado_dynamic_css( '.mkdf-shopping-cart-holder a.mkdf-header-cart, .mkdf-shopping-cart-holder a.mkdf-header-cart .mkdf-sc-opener-count', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo biagiotti_mikado_dynamic_css( '.mkdf-shopping-cart-holder a.mkdf-header-cart:hover, .mkdf-shopping-cart-holder a.mkdf-header-cart:hover .mkdf-sc-opener-count', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'biagiotti_mikado_action_style_dynamic', 'biagiotti_mikado_dropdown_cart_icon_styles' );
}