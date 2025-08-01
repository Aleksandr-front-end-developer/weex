<?php do_action('biagiotti_mikado_action_before_page_header'); ?>

<aside class="mkdf-vertical-menu-area <?php echo esc_attr($holder_class); ?>">
	<div class="mkdf-vertical-menu-area-inner">
		<div class="mkdf-vertical-area-background"></div>
		<?php if(!$hide_logo) {
			biagiotti_mikado_get_logo();
		} ?>
		<?php biagiotti_mikado_get_header_vertical_main_menu(); ?>
		<?php if (
				biagiotti_mikado_is_header_widget_area_active( 'two' ) ||
				biagiotti_mikado_is_header_widget_area_active( 'one' )
		) { ?>
			<div class="mkdf-vertical-area-widget-holder-outer">
				<?php if ( biagiotti_mikado_is_header_widget_area_active( 'two' ) ) { ?>
					<div class="mkdf-vertical-area-widget-holder">
						<?php biagiotti_mikado_get_header_widget_area_two(); ?>
					</div>
				<?php } ?>
				<?php if ( biagiotti_mikado_is_header_widget_area_active( 'one' ) ) { ?>
					<div class="mkdf-vertical-area-widget-holder mkdf-vertical-bottom-area">
						<?php biagiotti_mikado_get_header_widget_area_one(); ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</aside>

<?php do_action('biagiotti_mikado_action_after_page_header'); ?>