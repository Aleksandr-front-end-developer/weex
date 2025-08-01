<div class="mkdf-social-login-holder">
    <div class="mkdf-social-login-holder-inner">
        <form method="post" class="mkdf-login-form">
            <?php
            $redirect = '';
            if ( isset( $_GET['redirect_uri'] ) ) {
                $redirect = $_GET['redirect_uri'];
            } ?>
            <fieldset>
                <div>
                    <input type="text" name="user_login_name" id="user_login_name" placeholder="<?php esc_html_e( 'Username*', 'biagiotti-membership' ); ?>" value="" required pattern=".{3,}" title="<?php esc_attr_e( 'Three or more characters', 'biagiotti-membership' ); ?>"/>
                </div>
                <div>
                    <input type="password" name="user_login_password" id="user_login_password" placeholder="<?php esc_html_e( 'Password*', 'biagiotti-membership' ); ?>" value="" required/>
                </div>
             
                <input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url( $redirect ); ?>">
	            
	            <div class="mkdf-login-remember">
	                <div class="mkdf-login-button-holder">
	                    <?php
	                    if ( biagiotti_membership_theme_installed() ) {
	                        echo biagiotti_mikado_get_button_html( array(
		                        'html_type'              => 'button',
		                        'text'                   => esc_html__( 'Log in', 'biagiotti-membership' ),
		                        'type'                   => 'outline',
		                        'size'                   => 'medium'
	                        ) );
	                    } else {
	                        echo '<button type="submit">' . esc_html__( 'Login', 'biagiotti-membership' ) . '</button>';
	                    }
	                    ?>
	                    <?php wp_nonce_field( 'mkdf-ajax-login-nonce', 'mkdf-login-security' ); ?>
	                </div>
		            <div class="mkdf-remember-holder">
                            <span class="mkdf-login-remember">
                                <input name="rememberme" value="forever" id="rememberme" type="checkbox"/>
                                <label for="rememberme" class="mkdf-checbox-label"><?php esc_html_e( 'Remember me', 'biagiotti-membership' ) ?></label>
                            </span>
		            </div>
	            </div>
	            <div class="mkdf-lost-pass-remember-holder clearfix">
		            <div class="mkdf-lost-pass-holder">
			            <a href="#" class="mkdf-modal-opener" data-modal="password"><?php esc_html_e( 'Lost your password?', 'biagiotti-membership' ); ?></a>
		            </div>
	            </div>
                <div class="mkdf-register-link-holder">
	                <p class="mkdf-register-label"><?php esc_html_e( 'Don’t have an account?', 'biagiotti-membership' ); ?></p>
                    <a href="#" class="mkdf-btn mkdf-btn-huge mkdf-btn-outline mkdf-modal-opener " data-modal="register"><?php esc_html_e( 'Create an account', 'biagiotti-membership' ); ?></a>
                </div>
            </fieldset>
        </form>
    </div>
    <?php
    if(biagiotti_membership_theme_installed()) {
        //if social login enabled add social networks login
        $social_login_enabled = biagiotti_mikado_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
        if($social_login_enabled) { ?>
            <div class="mkdf-login-form-social-login">
                <div class="mkdf-login-social-title">
                    <?php esc_html_e('Recommended: Connect with Social Networks!', 'biagiotti-membership'); ?>
                </div>
                <div class="mkdf-login-social-networks">
                    <?php do_action('biagiotti_membership_social_network_login'); ?>
                </div>
            </div>
        <?php }
    }
    do_action( 'biagiotti_membership_action_login_ajax_response' );
    ?>
</div>