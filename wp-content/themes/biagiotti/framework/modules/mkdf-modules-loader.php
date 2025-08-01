<?php

if ( ! function_exists( 'biagiotti_mikado_load_modules' ) ) {
	/**
	 * Loades all modules by going through all folders that are placed directly in modules folder
	 * and loads load.php file in each. Hooks to biagiotti_mikado_action_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function biagiotti_mikado_load_modules() {
		foreach ( glob( BIAGIOTTI_MIKADO_FRAMEWORK_ROOT_DIR . '/modules/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'biagiotti_mikado_action_before_options_map', 'biagiotti_mikado_load_modules' );
}