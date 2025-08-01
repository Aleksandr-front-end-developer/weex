<?php
$current_user    = wp_get_current_user();
$name            = $current_user->display_name;
$current_user_id = $current_user->ID;
$membership_page_url = biagiotti_membership_get_dashboard_page_url();
?>
<div class="mkdf-logged-in-user">
    <div class="mkdf-logged-in-user-inner">
        <span>
            <?php if ( biagiotti_membership_theme_installed() ) {
                $profile_image = get_user_meta( $current_user_id, 'social_profile_image', true );
                if ( $profile_image == '' ) {
                    $profile_image = get_avatar( $current_user_id, 28 );
                } else {
                    $profile_image = '<img src="' . esc_url( $profile_image ) . '" />';
                }
                echo biagiotti_membership_kses_img( $profile_image );
            } ?>
            <span class="mkdf-logged-in-user-name"><?php echo esc_html( $name ); ?></span>
        </span>
    </div>
</div>
<ul class="mkdf-login-dropdown">
	<?php
	$nav_items = biagiotti_membership_get_dashboard_navigation_items();
    $logout_url = $membership_page_url !== '' ? $membership_page_url : home_url( '/' );
	foreach ( $nav_items as $nav_item ) { ?>
		<li>
			<a href="<?php echo esc_url($nav_item['url']); ?>">
                <span class="mkdf-login-dropdown-item-inner">
				    <?php echo esc_attr($nav_item['text']); ?>
                </span>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="<?php echo wp_logout_url( $logout_url ); ?>">
            <span class="mkdf-login-dropdown-item-inner">
			    <?php esc_html_e( 'Log Out', 'biagiotti-membership' ); ?>
            </span>
		</a>
	</li>
</ul>