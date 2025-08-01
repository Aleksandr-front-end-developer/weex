<?php

if ( ! function_exists( 'biagiotti_mikado_register_blog_centered_template_file' ) ) {
	/**
	 * Function that register blog centered template
	 */
	function biagiotti_mikado_register_blog_centered_template_file( $templates ) {
		$templates['blog-centered'] = esc_html__( 'Blog: Centered', 'biagiotti' );
		
		return $templates;
	}
	
	add_filter( 'biagiotti_mikado_filter_register_blog_templates', 'biagiotti_mikado_register_blog_centered_template_file' );
}

if ( ! function_exists( 'biagiotti_mikado_set_blog_centered_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function biagiotti_mikado_set_blog_centered_type_global_option( $options ) {
		$options['centered'] = esc_html__( 'Blog: Centered', 'biagiotti' );
		
		return $options;
	}
	
	add_filter( 'biagiotti_mikado_filter_blog_list_type_global_option', 'biagiotti_mikado_set_blog_centered_type_global_option' );
}