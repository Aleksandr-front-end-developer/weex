<?php
$image_meta   = get_post_meta( get_the_ID(), 'mkdf_blog_list_featured_image_meta', true );
$has_featured = ! empty( $image_meta ) || has_post_thumbnail();
?>

<div class="mkdf-bl-item mkdf-item-space">
	<div class="mkdf-bli-inner">
		<?php if ( $has_featured ) { ?>
			<div class="mkdf-bli-heading">
				<?php
				biagiotti_mikado_get_module_template_part( 'templates/parts/media', 'blog', '', $params );

				if ( $post_info_date == 'yes' ) {
					biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/date', 'blog', 'custom', $params );
				} ?>
			</div>
		<?php } ?>
		<div class="mkdf-bli-content">
			<div class="mkdf-bli-info">
				<?php
				if ( ! $has_featured && $post_info_date == 'yes' ) {
					biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
				}
				if ( $post_info_category == 'yes' ) {
					biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
				}
				if ( $post_info_author == 'yes' ) {
					biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
				}
				?>
			</div>

			<?php biagiotti_mikado_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
			
			<div class="mkdf-bli-excerpt">
				<?php biagiotti_mikado_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
				<?php biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
			</div>
		</div>
	</div>
</div>