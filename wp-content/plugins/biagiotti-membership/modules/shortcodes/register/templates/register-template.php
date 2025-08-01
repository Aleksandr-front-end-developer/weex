<div class="mkdf-social-register-holder">
	<form method="post" class="mkdf-register-form">
		<fieldset>
			<div>
				<input type="text" name="user_register_name" id="user_register_name" placeholder="<?php esc_html_e( 'Username*', 'biagiotti-membership' ); ?>" value="" required pattern=".{3,}" title="<?php esc_attr_e( 'Three or more characters', 'biagiotti-membership' ); ?>"/>
			</div>
			<div>
				<input type="email" name="user_register_email" id="user_register_email" placeholder="<?php esc_html_e( 'Email*', 'biagiotti-membership' ); ?>" value="" required />
			</div>
            <div>
                <input type="password" name="user_register_password" id="user_register_password" placeholder="<?php esc_html_e( 'Password*', 'biagiotti-membership' ); ?>" value="" required />
            </div>
            <div>
                <input type="password" name="user_register_confirm_password" id="user_register_confirm_password"  placeholder="<?php esc_html_e( 'Repeat Password*', 'biagiotti-membership' ); ?>" value="" required />
            </div>
            <label class="qodef-register-privacy-policy">
				<?php
				$privacy_policy_text      = biagiotti_membership_theme_installed() ? biagiotti_mikado_options()->getOptionValue( 'mkdf_membership_privacy_policy_text' ) : '';
				$privacy_policy_link      = biagiotti_membership_theme_installed() ? biagiotti_mikado_options()->getOptionValue( 'mkdf_membership_privacy_policy_link' ) : '';
				$privacy_policy_link_text = biagiotti_membership_theme_installed() ? biagiotti_mikado_options()->getOptionValue( 'mkdf_membership_privacy_policy_link_text' ) : '';

				$privacy_policy_text      = ! empty( $privacy_policy_text ) ? ( esc_html( $privacy_policy_text ) . ' %s.' ) : esc_html__( 'Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our %s.', 'biagiotti-membership' );
				$privacy_policy_link      = ! empty( $privacy_policy_link ) ? esc_url( get_permalink( $privacy_policy_link ) ) : esc_url( home_url( '/?page_id=3' ) ); // page id 3 is default terms and condition WordPage page
				$privacy_policy_link_text = ! empty( $privacy_policy_link_text ) ? esc_html( $privacy_policy_link_text ) : esc_html__( 'privacy policy', 'biagiotti-membership' );

				echo sprintf(
					$privacy_policy_text,
					'<a itemprop="url" class="qodef-register-privacy-policy-link" href="' . $privacy_policy_link . '" target="_blank">' . $privacy_policy_link_text . '</a>'
				);
				?>
            </label>
            <?php do_action('biagiotti_membership_additional_registration_field'); ?>
			<div class="mkdf-register-button-holder">
				<?php
				if ( biagiotti_membership_theme_installed() ) {
					echo biagiotti_mikado_get_button_html( array(
						'html_type'              => 'button',
						'text'                   => esc_html__( 'Register', 'biagiotti-membership' ),
						'type'                   => 'outline',
						'size'                   => 'medium'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'Register', 'biagiotti-membership' ) . '</button>';
				}
				wp_nonce_field( 'mkdf-ajax-register-nonce', 'mkdf-register-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'biagiotti_membership_action_login_ajax_response' ); ?>
</div>