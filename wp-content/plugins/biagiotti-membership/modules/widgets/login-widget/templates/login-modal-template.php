<div class="mkdf-login-holder mkdf-modal-holder" data-modal="login">
    <div class="mkdf-login-content mkdf-modal-content">
        <div class="mkdf-login-content-inner mkdf-modal-content-inner">
	        <div class="mkdf-login-content-text">
		        <p><?php esc_html_e("Already have an account?", "biagiotti-membership") ?></p>
		        <h2><?php esc_html_e("Log In", "biagiotti-membership") ?></h2>
	        </div>
            <div class="mkdf-wp-login-holder">
                <div class="mkdf-wp-login-holder"><?php echo biagiotti_membership_execute_shortcode( 'mkdf_user_login', array() ); ?></div>
            </div>
        </div>
    </div>
</div>