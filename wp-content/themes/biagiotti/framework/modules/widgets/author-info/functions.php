<?php

if ( ! function_exists( 'biagiotti_mikado_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function biagiotti_mikado_register_author_info_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_author_info_widget' );
}