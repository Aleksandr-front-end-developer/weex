<?php
get_header();
if ( biagiotti_membership_theme_installed() ) {
	biagiotti_mikado_get_title();
} else { ?>
	<div class="mkdf-membership-title">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
<?php }
do_action('biagiotti_mikado_action_before_main_content');
?>
	<div class="mkdf-container">
		<?php do_action( 'biagiotti_mikado_after_container_open' ); ?>
		<div class="mkdf-container-inner clearfix">
			<div class="mkdf-membership-main-wrapper clearfix">
				<?php if ( is_user_logged_in() ) { ?>
					<div class="mkdf-membership-dashboard-nav-holder clearfix">
						<div class="mkdf-membership-dashboard-nav-inner">
							<?php
							//Include dashboard navigation
							echo biagiotti_membership_get_dashboard_template_part( 'navigation' );
							?>
						</div>
					</div>
					<div class="mkdf-membership-dashboard-content-holder">
						<?php echo biagiotti_membership_get_dashboard_pages(); ?>
					</div>
				<?php } else { ?>
					<div class="mkdf-login-register-content mkdf-user-not-logged-in mkdf-tabs">
						<ul class="mkdf-tabs-nav">
							<li class="mkdf-login-tabs">
								<a href="#mkdf-login-content"><?php esc_html_e( 'Login', 'biagiotti-membership' ); ?></a>
							</li>
							<li class="register-tab">
								<a href="#mkdf-register-content"><?php esc_html_e( 'Register', 'biagiotti-membership' ); ?></a>
							</li>
							<li class="reset-tab">
								<a href="#mkdf-reset-pass-content"><?php esc_html_e( 'Reset Password', 'biagiotti-membership' ); ?></a>
							</li>
						</ul>
						<div class="mkdf-tab-container mkdf-login-content-inner" id="mkdf-login-content">
							<div class="mkdf-wp-login-holder"><?php echo biagiotti_membership_execute_shortcode( 'mkdf_user_login', array() ); ?></div>
						</div>
						<div class="mkdf-tab-container mkdf-register-content-inner" id="mkdf-register-content">
							<div class="mkdf-wp-register-holder"><?php echo biagiotti_membership_execute_shortcode( 'mkdf_user_register', array() ) ?></div>
						</div>
						<div class="mkdf-tab-container mkdf-reset-pass-content-inner" id="mkdf-reset-pass-content">
							<div class="mkdf-wp-reset-pass-holder"><?php echo biagiotti_membership_execute_shortcode( 'mkdf_user_reset_password', array() ) ?></div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php do_action( 'biagiotti_mikado_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>