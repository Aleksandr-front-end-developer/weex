<?php

if ( ! function_exists( 'biagiotti_mikado_include_woocommerce_shortcodes' ) ) {
	function biagiotti_mikado_include_woocommerce_shortcodes() {
		if( biagiotti_mikado_is_theme_registered() ) {
			foreach ( glob( BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}
	
	if ( biagiotti_mikado_is_plugin_installed( 'core' ) ) {
		add_action( 'biagiotti_core_action_include_shortcodes_file', 'biagiotti_mikado_include_woocommerce_shortcodes' );
	}
}

// Load woo elementor widgets
if ( ! function_exists( 'biagiotti_mikado_include_woo_elementor_widgets_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function biagiotti_mikado_include_woo_elementor_widgets_files() {
		if ( biagiotti_mikado_is_plugin_installed('core') && biagiotti_mikado_is_theme_registered() ) {
			foreach ( glob( BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*/elementor-*.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'biagiotti_mikado_include_woo_elementor_widgets_files' );
}
