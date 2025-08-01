<?php

if ( ! function_exists( 'biagiotti_core_add_section_title_shortcodes' ) ) {
	function biagiotti_core_add_section_title_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'BiagiottiCore\CPT\Shortcodes\SectionTitle\SectionTitle'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'biagiotti_core_filter_add_vc_shortcode', 'biagiotti_core_add_section_title_shortcodes' );
}

if ( ! function_exists( 'biagiotti_core_set_section_title_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for section title shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function biagiotti_core_set_section_title_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-section-title';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'biagiotti_core_filter_add_vc_shortcodes_custom_icon_class', 'biagiotti_core_set_section_title_icon_class_name_for_vc_shortcodes' );
}