<ul class="mkdf-membership-dashboard-nav clearfix">
	<?php
	$nav_items = biagiotti_membership_get_dashboard_navigation_items();
	$user_action = isset($_GET['user-action']) ? $_GET['user-action'] : 'profile';
	foreach ( $nav_items as $nav_item ) { ?>
		<li <?php if($user_action == $nav_item['user_action']){ echo 'class="mkdf-active-dash"'; } ?>>
			<a href="<?php echo esc_url($nav_item['url']); ?>">
                <?php if(isset($nav_item['icon'])){ ?>
                <?php } ?>
                <span class="mkdf-dash-label">
				    <?php echo esc_attr($nav_item['text']); ?>
                </span>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'Log out', 'biagiotti-membership' ); ?>
		</a>
	</li>
</ul>