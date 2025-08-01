<div class="mkdf-membership-dashboard-page">
	<div class="mkdf-membership-dashboard-page-content">
		<div class="mkdf-profile-image">
            <?php echo biagiotti_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'First name', 'biagiotti-membership' ); ?>:</span>
			<?php echo esc_attr($first_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last name', 'biagiotti-membership' ); ?>:</span>
			<?php echo esc_attr($last_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'biagiotti-membership' ); ?>:</span>
			<?php echo esc_attr($email); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'biagiotti-membership' ); ?>:</span>
			<?php echo esc_attr($description); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'biagiotti-membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo esc_url($website); ?></a>
		</p>
	</div>
</div>
