<?php

if ( ! function_exists( 'biagiotti_core_include_reviews_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function biagiotti_core_include_reviews_shortcodes_files() {
        if ( biagiotti_core_theme_installed() && biagiotti_core_is_theme_registered() ) {
            foreach (glob(BIAGIOTTI_CORE_ABS_PATH . '/reviews/shortcodes/*/load.php') as $shortcode_load) {
                include_once $shortcode_load;
            }
        }
	}
	
	add_action( 'biagiotti_core_action_include_shortcodes_file', 'biagiotti_core_include_reviews_shortcodes_files' );
}