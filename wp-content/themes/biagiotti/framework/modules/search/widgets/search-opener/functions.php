<?php

if ( ! function_exists( 'biagiotti_mikado_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function biagiotti_mikado_register_search_opener_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_search_opener_widget' );
}