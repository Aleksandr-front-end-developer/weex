<?php

if ( ! function_exists( 'biagiotti_mikado_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function biagiotti_mikado_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_sticky_sidebar_widget' );
}