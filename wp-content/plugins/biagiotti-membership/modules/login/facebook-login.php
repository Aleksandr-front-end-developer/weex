<?php
/**
 * Functions for Facebook login
 */

if (!function_exists('biagiotti_membership_get_facebook_social_login')) {
    /**
     * Render form for facebook login
     */
    function biagiotti_membership_get_facebook_social_login() {
        $social_login_enabled = biagiotti_mikado_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
        $facebook_login_enabled = biagiotti_mikado_options()->getOptionValue('enable_facebook_social_login') == 'yes' ? true : false;
        $enabled = ($social_login_enabled && $facebook_login_enabled) ? true : false;

        if (!is_user_logged_in() && $enabled) {

            $html = '<form class="mkdf-facebook-login-holder">'
                . wp_nonce_field('mkdf_validate_facebook_login', 'mkdf_nonce_facebook_login_' . rand(), true, false) .
                biagiotti_mikado_get_button_html(array(
                    'html_type'              => 'button',
                    'button_arrow'        => 'no',
                    'custom_class'           => 'mkdf-facebook-login',
                    'icon_pack'              => 'font_elegant',
                    'fe_icon'                => 'social_facebook',
                    'size'                   => 'small',
                    'text'                   => 'FACEBOOK',
                    'color'                  => '#3b5998',
                    'background_color'       => '#fff',
                    'hover_background_color' => '#3b5998',
                    'hover_border_color'     => '#3b5998',
                    'hover_color'            => '#fff'
                )) .
                '</form>';
            echo biagiotti_mikado_get_module_part( $html );
        }
    }

    add_action('biagiotti_membership_social_network_login', 'biagiotti_membership_get_facebook_social_login');
}

if (!function_exists('biagiotti_membership_check_facebook_user')) {
    /**
     * Function for getting facebook user data.
     * Checks for user mail and register or log in user
     */
    function biagiotti_membership_check_facebook_user() {

        if (isset($_POST['response'])) {
            $response = $_POST['response'];
            $user_email = $response['email'];
            $network = 'facebook';
            $response['network'] = $network;
            $nonce = $response['nonce'];

	        if ( email_exists( $user_email ) ) {

		        if ( isset( $response['accessToken'] ) && ! empty( $response['id'] ) ) {
			        $check_social_user = file_get_contents( 'https://graph.facebook.com/' . $response['id'] . '?fields=email&access_token=' . trim( wp_unslash( $response['accessToken'] ) ) );

			        if ( ! empty( $check_social_user ) ) {
				        $check_social_user = json_decode( $check_social_user, true );

				        if ( isset( $check_social_user['id'] ) && $check_social_user['id'] === $response['id'] && $user_email === $check_social_user['email'] ) {
					        biagiotti_membership_login_user_from_social_network( $user_email, $nonce, $network );
				        } else {
					        biagiotti_membership_ajax_response( 'error', esc_html__( 'Username or password is invalid.', 'biagiotti-membership' ) );
				        }
			        } else {
				        biagiotti_membership_ajax_response( 'error', esc_html__( 'Username or password is invalid.', 'biagiotti-membership' ) );
			        }
		        } else {
			        biagiotti_membership_ajax_response( 'error', esc_html__( 'Username or password is invalid.', 'biagiotti-membership' ) );
		        }

            } else {
                //Register new user
                biagiotti_membership_register_user_from_social_network($response);
            }
            $url = biagiotti_membership_get_dashboard_page_url();
            if ($url == '') {
                $url = esc_url(home_url('/'));
            }
            biagiotti_membership_ajax_response('success', esc_html__('Login successful, redirecting...', 'biagiotti-membership'), $url);
        }

        wp_die();
    }

    add_action('wp_ajax_biagiotti_membership_check_facebook_user', 'biagiotti_membership_check_facebook_user');
    add_action('wp_ajax_nopriv_biagiotti_membership_check_facebook_user', 'biagiotti_membership_check_facebook_user');
}