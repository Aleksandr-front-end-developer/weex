<form action="<?php echo esc_url( site_url( '/'.SEARCH_SLUG ) ); ?>" class="mkdf-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="mkdf-container">
		<div class="mkdf-container-inner clearfix">
	<?php } ?>
			<div class="mkdf-form-holder-outer">
				<div class="mkdf-form-holder">
					<div class="mkdf-form-holder-inner">
						<input type="text" placeholder="<?php esc_attr_e( 'Search...', 'biagiotti' ); ?>" name="s" class="mkdf_search_field" autocomplete="off" required />
						<a <?php biagiotti_mikado_class_attribute( $search_close_icon_class ); ?> href="#">
							<?php echo biagiotti_mikado_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
						</a>
					</div>
				</div>
			</div>
	<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>