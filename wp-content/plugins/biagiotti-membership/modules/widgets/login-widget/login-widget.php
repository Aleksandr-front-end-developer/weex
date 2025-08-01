<?php

class BiagiottiMembershipLoginRegister extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'mkdf_login_register_widget',
			esc_html__( 'Biagiotti Login Widget', 'biagiotti-membership' ),
			array( 'description' => esc_html__( 'Login and register membership widget', 'biagiotti-membership' ) )
		);
	}

//    public function widget( $args, $instance ) {
//        $additional_class = is_user_logged_in() ? 'mkdf-user-logged-in' : 'mkdf-user-not-logged-in';
//
//        echo '<div class="widget mkdf-login-register-widget ' . esc_attr( $additional_class ) . '">';
//        if ( ! is_user_logged_in() ) {
//            echo biagiotti_membership_get_module_template_part( 'widgets', 'login-widget', 'login-widget-template', 'logged-out' );
//        } else {
//            echo biagiotti_membership_get_module_template_part( 'widgets', 'login-widget', 'login-widget-template', 'logged-in' );
//        }
//        echo '</div>';
//    }

    public function widget( $args, $instance ) {
        $additional_class = '';
        if ( is_user_logged_in() ) {
            $additional_class .= 'mkdf-user-logged-in';
        } else {
            $additional_class .= 'mkdf-user-not-logged-in';
        }

        echo '<div class="widget mkdf-login-register-widget ' . esc_attr( $additional_class ) . '">';
        if ( ! is_user_logged_in() ) {
            echo '<a href="#" class="mkdf-modal-opener mkdf-login-opener" data-modal="login">' . esc_html__( 'Log In', 'biagiotti-membership' ) . '</a>';

            add_action( 'wp_footer', array( $this, 'mkdf_membership_render_login_form' ) );
            add_action( 'wp_footer', array( $this, 'mkdf_membership_render_register_form' ) );
            add_action( 'wp_footer', array( $this, 'mkdf_membership_render_password_form' ) );
        } else {
            echo biagiotti_membership_get_module_template_part( 'widgets', 'login-widget', 'login-widget-template' );
        }
        echo '</div>';
    }

    public function mkdf_membership_render_login_form() {

        //Render modal with login and register forms
        echo biagiotti_membership_get_module_template_part( 'widgets', 'login-widget', 'login-modal-template' );
    }

    public function mkdf_membership_render_register_form() {

        //Render modal with login and register forms
        echo biagiotti_membership_get_module_template_part( 'widgets', 'login-widget', 'register-modal-template' );
    }

    public function mkdf_membership_render_password_form() {

        //Render modal with login and register forms
        echo biagiotti_membership_get_module_template_part( 'widgets', 'login-widget', 'password-modal-template' );
    }
}

if ( ! function_exists( 'biagiotti_membership_login_widget_load' ) ) {
	function biagiotti_membership_login_widget_load() {
		register_widget( 'BiagiottiMembershipLoginRegister' );
	}
	
	add_action( 'widgets_init', 'biagiotti_membership_login_widget_load' );
}

