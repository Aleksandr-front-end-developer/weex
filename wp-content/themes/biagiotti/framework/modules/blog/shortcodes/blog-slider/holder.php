<div class="mkdf-blog-slider-holder">
	<div class="mkdf-blog-slider mkdf-owl-slider" <?php echo biagiotti_mikado_get_inline_attrs( $slider_data ); ?>>
		<?php
		if ( $query_result->have_posts() ):
			while ( $query_result->have_posts() ) : $query_result->the_post();
				biagiotti_mikado_get_module_template_part( 'shortcodes/blog-slider/layout-collections/carousel', 'blog', '', $params );
			endwhile;
		else: ?>
			<div class="mkdf-blog-slider-message">
				<p><?php esc_html_e( 'No posts were found.', 'biagiotti' ); ?></p>
			</div>
		<?php endif;
		
		wp_reset_postdata();
		?>
	</div>
</div>
