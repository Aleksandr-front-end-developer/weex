<?php

if ( ! function_exists( 'biagiotti_membership_add_register_shortcodes' ) ) {
	function biagiotti_membership_add_register_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'BiagiottiMembership\Shortcodes\BiagiottiUserRegister\BiagiottiUserRegister'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'biagiotti_membership_filter_add_vc_shortcode', 'biagiotti_membership_add_register_shortcodes' );
}