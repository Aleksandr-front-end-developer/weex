<?php

if ( ! function_exists( 'biagiotti_mikado_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function biagiotti_mikado_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_recent_posts_widget' );
}