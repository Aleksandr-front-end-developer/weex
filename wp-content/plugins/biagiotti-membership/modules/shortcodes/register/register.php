<?php

namespace BiagiottiMembership\Shortcodes\BiagiottiUserRegister;

use BiagiottiMembership\Lib\ShortcodeInterface;

class BiagiottiUserRegister implements ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_user_register';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {}
	
	public function render( $atts, $content = null ) {
		$args   = array();
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		
		$html = '';
		
		if ( ! is_user_logged_in() ) {
			if ( get_option( 'users_can_register' ) ) {
				$html .= biagiotti_membership_get_module_template_part( 'shortcodes', 'register', 'register-template', '', $params );
			} else {
				$message = esc_html__( "You don't have permission to register", 'biagiotti-membership' );
				$html    .= biagiotti_membership_get_module_template_part( 'shortcodes', 'register', 'register-message', '', array( 'message' => $message ) );
			}
		} else {
			$message = esc_html__( 'You are already logged in', 'biagiotti-membership' );
			$html    .= biagiotti_membership_get_module_template_part( 'shortcodes', 'register', 'register-message', '', array( 'message' => $message ) );
		}
		
		return $html;
	}
}