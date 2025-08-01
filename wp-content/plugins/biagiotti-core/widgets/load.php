<?php

if ( ! function_exists( 'biagiotti_core_load_widget_class' ) ) {
	/**
	 * Loades widget class file.
	 */
	function biagiotti_core_load_widget_class() {
		include_once 'widget-class.php';
	}
	
	add_action( 'biagiotti_mikado_action_before_options_map', 'biagiotti_core_load_widget_class' );
}

if ( ! function_exists( 'biagiotti_core_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to biagiotti_mikado_action_after_options_map action
	 */
	function biagiotti_core_load_widgets() {
		
		if ( biagiotti_core_theme_installed() ) {
			foreach ( glob( BIAGIOTTI_MIKADO_FRAMEWORK_ROOT_DIR . '/modules/widgets/*/load.php' ) as $widget_load ) {
				include_once $widget_load;
			}
		}
		
		include_once 'widget-loader.php';
	}
	
	add_action( 'biagiotti_mikado_action_before_options_map', 'biagiotti_core_load_widgets' );
}