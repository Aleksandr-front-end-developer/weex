<?php

if ( ! function_exists( 'biagiotti_mikado_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function biagiotti_mikado_register_blog_list_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_blog_list_widget' );
}