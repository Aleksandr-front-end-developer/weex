<?php

if ( ! function_exists( 'biagiotti_mikado_disable_behaviors_for_header_vertical' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function biagiotti_mikado_disable_behaviors_for_header_vertical( $allow_behavior ) {
		return false;
	}
	
	if ( biagiotti_mikado_check_is_header_type_enabled( 'header-vertical', biagiotti_mikado_get_page_id() ) ) {
		add_filter( 'biagiotti_mikado_filter_allow_sticky_header_behavior', 'biagiotti_mikado_disable_behaviors_for_header_vertical' );
		add_filter( 'biagiotti_mikado_filter_allow_content_boxed_layout', 'biagiotti_mikado_disable_behaviors_for_header_vertical' );
	}
}