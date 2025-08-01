<?php

if ( ! function_exists( 'biagiotti_mikado_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function biagiotti_mikado_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'biagiotti' );
		
		return $templates;
	}
	
	add_filter( 'biagiotti_mikado_filter_register_blog_templates', 'biagiotti_mikado_register_blog_standard_template_file' );
}

if ( ! function_exists( 'biagiotti_mikado_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function biagiotti_mikado_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'biagiotti' );
		
		return $options;
	}
	
	add_filter( 'biagiotti_mikado_filter_blog_list_type_global_option', 'biagiotti_mikado_set_blog_standard_type_global_option' );
}