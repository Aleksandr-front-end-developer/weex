<?php

if ( ! function_exists( 'biagiotti_core_testimonials_meta_box_functions' ) ) {
	function biagiotti_core_testimonials_meta_box_functions( $post_types ) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter( 'biagiotti_mikado_filter_meta_box_post_types_save', 'biagiotti_core_testimonials_meta_box_functions' );
	add_filter( 'biagiotti_mikado_filter_meta_box_post_types_remove', 'biagiotti_core_testimonials_meta_box_functions' );
}

if ( ! function_exists( 'biagiotti_core_register_testimonials_cpt' ) ) {
	function biagiotti_core_register_testimonials_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'BiagiottiCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'biagiotti_core_filter_register_custom_post_types', 'biagiotti_core_register_testimonials_cpt' );
}

// Load testimonials shortcodes
if ( ! function_exists( 'biagiotti_core_include_testimonials_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function biagiotti_core_include_testimonials_shortcodes_files() {
		if( biagiotti_core_is_theme_registered() ) {
			foreach ( glob( BIAGIOTTI_CORE_CPT_PATH . '/testimonials/shortcodes/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action( 'biagiotti_core_action_include_shortcodes_file', 'biagiotti_core_include_testimonials_shortcodes_files' );
}

// Load portfolio elementor widgets
if ( ! function_exists( 'biagiotti_core_include_testimonials_elementor_widgets_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function biagiotti_core_include_testimonials_elementor_widgets_files() {
		if ( biagiotti_core_theme_installed() && biagiotti_mikado_is_elementor_installed() && biagiotti_core_is_theme_registered() ) {
			foreach (glob(BIAGIOTTI_CORE_CPT_PATH . '/testimonials/shortcodes/*/elementor-*.php') as $shortcode_load) {
				include_once $shortcode_load;
			}
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'biagiotti_core_include_testimonials_elementor_widgets_files' );
}
