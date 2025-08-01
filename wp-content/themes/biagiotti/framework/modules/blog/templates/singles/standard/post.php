<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<div class="mkdf-post-heading"><!--
			--><?php biagiotti_mikado_get_module_template_part( 'templates/parts/media', 'blog', $post_format, $part_params ); ?><!--
	--></div>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner">
				<div class="mkdf-post-info-top">
					<?php biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $part_params ); ?>
					<?php biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $part_params ); ?>
					<?php biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $part_params ); ?>
					<?php biagiotti_mikado_get_module_template_part( 'templates/parts/title', 'blog', '', $part_params ); ?>
				</div>
				<div class="mkdf-post-text-main">
					<?php the_content(); ?>
					<?php do_action( 'biagiotti_mikado_action_single_link_pages' ); ?>
				</div>
				<div class="mkdf-post-info-bottom clearfix">
					<div class="mkdf-post-info-bottom-left">
						<?php biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/tags', 'blog', '', $part_params ); ?>
					</div>
					<div class="mkdf-post-info-bottom-right">
						<?php biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $part_params ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>