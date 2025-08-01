<?php

if ( ! function_exists( 'biagiotti_mikado_include_blog_shortcodes' ) ) {
	function biagiotti_mikado_include_blog_shortcodes() {
		if( biagiotti_mikado_is_theme_registered() ) {
			foreach ( glob( BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}
	
	if ( biagiotti_mikado_is_plugin_installed( 'core' ) ) {
		add_action( 'biagiotti_core_action_include_shortcodes_file', 'biagiotti_mikado_include_blog_shortcodes' );
	}
}

// Load blog elementor widgets
if ( ! function_exists( 'biagiotti_mikado_include_blog_elementor_widgets_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function biagiotti_mikado_include_blog_elementor_widgets_files() {
		if ( biagiotti_mikado_is_plugin_installed('core') && biagiotti_mikado_is_theme_registered() ) {
			foreach ( glob( BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/elementor-*.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'biagiotti_mikado_include_blog_elementor_widgets_files' );
}
