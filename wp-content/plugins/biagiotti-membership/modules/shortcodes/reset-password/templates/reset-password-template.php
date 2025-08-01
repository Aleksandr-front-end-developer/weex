<div class="mkdf-social-reset-password-holder">
	<form action="<?php echo site_url( 'wp-login.php?action=lostpassword' ); ?>" method="post" id="mkdf-lost-password-form" class="mkdf-reset-pass-form">
		<div>
			<input type="text" name="user_reset_password_login" class="mkdf-input-field" id="user_reset_password_login" placeholder="<?php esc_attr_e( 'Enter username or email', 'biagiotti-membership' ) ?>" value="" size="20" required>
		</div>
		<?php do_action( 'lostpassword_form' ); ?>
		<div class="mkdf-reset-password-button-holder">
			<?php
			if ( biagiotti_membership_theme_installed() ) {
				echo biagiotti_mikado_get_button_html( array(
					'html_type' => 'button',
					'text'      => esc_html__( 'New Password', 'biagiotti-membership' ),
					'type'      => 'outline',
					'size'      => 'medium'
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'New Password', 'biagiotti-membership' ) . '</button>';
			}
			?>
		</div>
	</form>
	<?php do_action( 'biagiotti_membership_action_login_ajax_response' ); ?>
</div>