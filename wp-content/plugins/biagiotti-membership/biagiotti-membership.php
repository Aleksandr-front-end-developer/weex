<?php
/**
 * Plugin Name: Biagiotti Membership
 * Description: Plugin that adds social login and user dashboard page
 * Author: Mikado Themes
 * Version: 1.1
 */

require_once 'load.php';

if ( ! function_exists( 'biagiotti_membership_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function biagiotti_membership_text_domain() {
		load_plugin_textdomain( 'biagiotti-membership', false, BIAGIOTTI_MEMBERSHIP_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'biagiotti_membership_text_domain' );
}

if ( ! function_exists( 'biagiotti_membership_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function biagiotti_membership_scripts() {
		wp_enqueue_style( 'biagiotti-membership-style', plugins_url( BIAGIOTTI_MEMBERSHIP_REL_PATH . '/assets/css/membership.min.css' ) );
		if ( function_exists( 'biagiotti_mikado_is_responsive_on' ) && biagiotti_mikado_is_responsive_on() ) {
			wp_enqueue_style( 'biagiotti-membership-responsive-style', plugins_url( BIAGIOTTI_MEMBERSHIP_REL_PATH . '/assets/css/membership-responsive.min.css' ) );
		}
		
		//underscore for facebook and google login
		//tabs for login widget
		$array_deps = array(
			'underscore',
			'jquery-ui-tabs'
		);
		
		if ( biagiotti_membership_theme_installed() ) {
			$array_deps[] = 'biagiotti-mikado-modules';
		}
		
		wp_enqueue_script( 'biagiotti-membership-script', plugins_url( BIAGIOTTI_MEMBERSHIP_REL_PATH . '/assets/js/membership.min.js' ), $array_deps, false, true );
	}
	
	add_action( 'wp_enqueue_scripts', 'biagiotti_membership_scripts' );
}

if ( ! function_exists( 'biagiotti_membership_style_dynamics_deps' ) ) {
	function biagiotti_membership_style_dynamics_deps( $deps ) {
		$style_dynamic_deps_array   = array();
		$style_dynamic_deps_array[] = 'biagiotti-membership-style';
		
		if ( function_exists( 'biagiotti_mikado_is_responsive_on' ) && biagiotti_mikado_is_responsive_on() ) {
			$style_dynamic_deps_array[] = 'biagiotti-membership-responsive-style';
		}
		
		return array_merge( $deps, $style_dynamic_deps_array );
	}
	
	add_filter( 'biagiotti_mikado_filter_style_dynamic_deps', 'biagiotti_membership_style_dynamics_deps' );
}
