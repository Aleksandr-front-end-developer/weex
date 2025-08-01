<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'biagiotti_instagram_add_instagram_list_shortcodes' ) ) {
	function biagiotti_instagram_add_instagram_list_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'BiagiottiInstagram\Shortcodes\InstagramList\InstagramList',
		);

		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

		return $shortcodes_class_name;
	}

	add_filter( 'biagiotti_instagram_filter_add_vc_shortcode', 'biagiotti_instagram_add_instagram_list_shortcodes' );
}

if ( ! function_exists( 'biagiotti_instagram_set_instagram_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for instagram list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function biagiotti_instagram_set_instagram_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-instagram-list';

		return $shortcodes_icon_class_array;
	}

	add_filter( 'biagiotti_core_filter_add_vc_shortcodes_custom_icon_class', 'biagiotti_instagram_set_instagram_list_icon_class_name_for_vc_shortcodes' );
}
