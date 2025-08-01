<?php

if ( ! function_exists( 'biagiotti_mikado_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function biagiotti_mikado_register_separator_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_separator_widget' );
}