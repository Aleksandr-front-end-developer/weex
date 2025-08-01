<?php
get_header();
biagiotti_mikado_get_title();
do_action( 'biagiotti_mikado_action_before_main_content' ); ?>
<div class="mkdf-container mkdf-default-page-template">
	<?php do_action( 'biagiotti_mikado_action_after_container_open' ); ?>
	<div class="mkdf-container-inner clearfix">
		<?php
			$biagiotti_taxonomy_id   = get_queried_object_id();
			$biagiotti_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$biagiotti_taxonomy      = ! empty( $biagiotti_taxonomy_id ) ? get_term_by( 'id', $biagiotti_taxonomy_id, $biagiotti_taxonomy_type ) : '';
			$biagiotti_taxonomy_slug = ! empty( $biagiotti_taxonomy ) ? $biagiotti_taxonomy->slug : '';
			$biagiotti_taxonomy_name = ! empty( $biagiotti_taxonomy ) ? $biagiotti_taxonomy->taxonomy : '';
			
			biagiotti_core_get_archive_portfolio_list( $biagiotti_taxonomy_slug, $biagiotti_taxonomy_name );
		?>
	</div>
	<?php do_action( 'biagiotti_mikado_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
