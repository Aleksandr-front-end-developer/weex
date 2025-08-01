<?php

if ( ! function_exists( 'biagiotti_mikado_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function biagiotti_mikado_register_button_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_button_widget' );
}