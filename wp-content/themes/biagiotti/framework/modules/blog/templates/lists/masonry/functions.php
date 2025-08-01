<?php

if ( ! function_exists( 'biagiotti_mikado_register_blog_masonry_template_file' ) ) {
	/**
	 * Function that register blog masonry template
	 */
	function biagiotti_mikado_register_blog_masonry_template_file( $templates ) {
		$templates['blog-masonry'] = esc_html__( 'Blog: Masonry', 'biagiotti' );
		
		return $templates;
	}
	
	add_filter( 'biagiotti_mikado_filter_register_blog_templates', 'biagiotti_mikado_register_blog_masonry_template_file' );
}

if ( ! function_exists( 'biagiotti_mikado_set_blog_masonry_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function biagiotti_mikado_set_blog_masonry_type_global_option( $options ) {
		$options['masonry'] = esc_html__( 'Blog: Masonry', 'biagiotti' );
		
		return $options;
	}
	
	add_filter( 'biagiotti_mikado_filter_blog_list_type_global_option', 'biagiotti_mikado_set_blog_masonry_type_global_option' );
}