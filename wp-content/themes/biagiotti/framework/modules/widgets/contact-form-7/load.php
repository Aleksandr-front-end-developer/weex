<?php

if ( biagiotti_mikado_is_plugin_installed( 'contact-form-7' ) ) {
	include_once BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_cf7_widget' );
}

if ( ! function_exists( 'biagiotti_mikado_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function biagiotti_mikado_register_cf7_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassContactForm7Widget';
		
		return $widgets;
	}
}