<?php

if ( ! function_exists( 'biagiotti_mikado_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function biagiotti_mikado_register_social_icons_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_social_icons_widget' );
}