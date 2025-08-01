<?php

if ( ! function_exists( 'biagiotti_core_add_dropcaps_shortcodes' ) ) {
	function biagiotti_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'BiagiottiCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'biagiotti_core_filter_add_vc_shortcode', 'biagiotti_core_add_dropcaps_shortcodes' );
}