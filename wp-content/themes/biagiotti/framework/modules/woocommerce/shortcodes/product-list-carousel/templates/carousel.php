<?php
$shader_styles          = $this_object->getShaderStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="mkdf-plc-holder <?php echo esc_attr( $holder_classes ) ?>">
	<div class="mkdf-plc-outer mkdf-owl-slider" <?php echo biagiotti_mikado_get_inline_attrs( $holder_data ); ?>>
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post(); ?>
			<div class="mkdf-plc">
				<div class="mkdf-plc-inner">
					<div class="mkdf-plc-image">
						<?php biagiotti_mikado_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
					</div>
					<div class="mkdf-plc-text" <?php echo biagiotti_mikado_get_inline_style( $shader_styles ); ?>>
						<div class="mkdf-plc-text-outer">
							<div class="mkdf-plc-text-inner">
								<?php biagiotti_mikado_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>
								<?php biagiotti_mikado_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>
								<?php biagiotti_mikado_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>
								<?php biagiotti_mikado_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
								<?php biagiotti_mikado_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>

								<div class="mkdf-plc-text-action">
									<?php biagiotti_mikado_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
									<?php do_action('biagiotti_mikado_action_product_list_shortcode'); ?>
								</div>
							</div>
						</div>
					</div>
					<a class="mkdf-plc-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
				</div>
			</div>
		<?php endwhile;
		else:
			biagiotti_mikado_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>