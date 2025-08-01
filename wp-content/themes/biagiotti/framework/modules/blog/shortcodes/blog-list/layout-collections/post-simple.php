<li class="mkdf-bl-item mkdf-item-space clearfix">
	<div class="mkdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			biagiotti_mikado_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
		<div class="mkdf-bli-content">
			<?php biagiotti_mikado_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
			<?php biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params ); ?>
			<?php biagiotti_mikado_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params ); ?>
		</div>
	</div>
</li>