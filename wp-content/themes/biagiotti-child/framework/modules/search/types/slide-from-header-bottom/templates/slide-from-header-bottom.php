<div class="mkdf-slide-from-header-bottom-holder">
	<form action="<?php echo esc_url( site_url( '/'.SEARCH_SLUG ) ); ?>" method="get">
		<div class="mkdf-form-holder">
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'biagiotti' ); ?>" name="s" class="mkdf-search-field" autocomplete="off" required />
			<button type="submit" <?php biagiotti_mikado_class_attribute( $search_submit_icon_class ); ?>>
				<?php echo biagiotti_mikado_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?>
			</button>
		</div>
	</form>
</div>