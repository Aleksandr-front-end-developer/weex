<div class="mkdf-pls-holder mkdf-grid-list mkdf-disable-bottom-space <?php echo esc_attr($holder_classes) ?>">
    <div class="mkdf-pls-outer mkdf-outer-space">
        <?php if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post(); ?>
	        <div class="mkdf-pls mkdf-item-space">
		        <div class="mkdf-pli-inner">
	                <div class="mkdf-pls-image">
	                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	                        <?php biagiotti_mikado_get_module_template_part('templates/parts/image-simple', 'woocommerce', '', $params); ?>
	                    </a>
	                </div>
	                <div class="mkdf-pls-text">
	                    <?php biagiotti_mikado_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>

	                    <?php biagiotti_mikado_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>

	                    <?php biagiotti_mikado_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>

	                    <?php biagiotti_mikado_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
	                </div>
		        </div>
            </div>
        <?php endwhile; else: ?>
            <div class="mkdf-pls-messsage">
                <?php biagiotti_mikado_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params); ?>
            </div>
        <?php endif;
            wp_reset_postdata();
        ?>
    </div>
</div>