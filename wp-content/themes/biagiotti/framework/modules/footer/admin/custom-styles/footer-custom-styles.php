<?php

if ( ! function_exists( 'biagiotti_mikado_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function biagiotti_mikado_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = biagiotti_mikado_options()->getOptionValue( 'footer_top_background_color' );
		$border_color     = biagiotti_mikado_options()->getOptionValue( 'footer_top_border_color' );
		$border_width     = biagiotti_mikado_options()->getOptionValue( 'footer_top_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = biagiotti_mikado_filter_px( $border_width ) . 'px';
		}
		
		echo biagiotti_mikado_dynamic_css( '.mkdf-page-footer .mkdf-footer-top-holder', $item_styles );
	}
	
	add_action( 'biagiotti_mikado_action_style_dynamic', 'biagiotti_mikado_footer_top_general_styles' );
}

if ( ! function_exists( 'biagiotti_mikado_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function biagiotti_mikado_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = biagiotti_mikado_options()->getOptionValue( 'footer_bottom_background_color' );
		$border_color     = biagiotti_mikado_options()->getOptionValue( 'footer_bottom_border_color' );
		$border_width     = biagiotti_mikado_options()->getOptionValue( 'footer_bottom_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = biagiotti_mikado_filter_px( $border_width ) . 'px';
		}
		
		echo biagiotti_mikado_dynamic_css( '.mkdf-page-footer .mkdf-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'biagiotti_mikado_action_style_dynamic', 'biagiotti_mikado_footer_bottom_general_styles' );
}