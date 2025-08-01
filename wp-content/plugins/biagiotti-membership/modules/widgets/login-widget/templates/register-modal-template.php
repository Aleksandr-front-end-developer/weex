<div class="mkdf-register-holder mkdf-modal-holder" data-modal="register">
    <div class="mkdf-register-content mkdf-modal-content">
        <div class="mkdf-register-content-inner mkdf-modal-content-inner" id="mkdf-register-content">
	        <div class="mkdf-login-content-text">
		        <h2><?php esc_html_e("Create An Account", "biagiotti-membership") ?></h2>
	        </div>
            <div class="mkdf-wp-register-holder">
                <?php echo biagiotti_membership_execute_shortcode( 'mkdf_user_register', array() ) ?>
            </div>
        </div>
    </div>
</div>