<?php

if ( ! function_exists( 'biagiotti_mikado_set_hide_dep_options_title_custom' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this title type is selected
	 */
	function biagiotti_mikado_set_hide_dep_options_title_custom( $hide_dep_options ) {
		$hide_dep_options[] = 'custom';
		
		return $hide_dep_options;
	}
	
	// hide breadcrumbs meta
	add_filter( 'biagiotti_mikado_filter_breadcrumbs_title_hide_meta_boxes', 'biagiotti_mikado_set_hide_dep_options_title_custom' );
}