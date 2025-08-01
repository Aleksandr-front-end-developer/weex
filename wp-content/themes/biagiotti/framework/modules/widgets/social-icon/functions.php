<?php

if ( ! function_exists( 'biagiotti_mikado_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function biagiotti_mikado_register_social_icon_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_social_icon_widget' );
}