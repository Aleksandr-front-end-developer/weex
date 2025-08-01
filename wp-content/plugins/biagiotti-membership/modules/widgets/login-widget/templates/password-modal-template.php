<div class="mkdf-password-holder mkdf-modal-holder" data-modal="password">
    <div class="mkdf-password-content mkdf-modal-content">
        <div class="mkdf-reset-pass-content-inner mkdf-modal-content-inner" id="mkdf-reset-pass-content">
            <h2><?php esc_html_e('Reset Password', 'biagiotti-membership') ?></h2>
            <div class="mkdf-wp-reset-pass-holder">
                <?php echo biagiotti_membership_execute_shortcode( 'mkdf_user_reset_password', array() ) ?>
            </div>
        </div>
    </div>
</div>