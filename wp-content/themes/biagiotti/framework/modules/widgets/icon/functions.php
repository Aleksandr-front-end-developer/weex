<?php

if ( ! function_exists( 'biagiotti_mikado_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function biagiotti_mikado_register_icon_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_icon_widget' );
}