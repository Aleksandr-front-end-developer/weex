<?php

if ( ! function_exists( 'biagiotti_mikado_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function biagiotti_mikado_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_sidearea_opener_widget' );
}