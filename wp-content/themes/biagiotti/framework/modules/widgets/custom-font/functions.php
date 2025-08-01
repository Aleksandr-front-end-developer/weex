<?php

if ( ! function_exists( 'biagiotti_mikado_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function biagiotti_mikado_register_custom_font_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_custom_font_widget' );
}