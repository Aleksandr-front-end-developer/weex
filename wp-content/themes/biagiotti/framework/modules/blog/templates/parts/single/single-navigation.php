<?php
$blog_single_navigation = biagiotti_mikado_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = biagiotti_mikado_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
	<div class="mkdf-blog-single-navigation">
		<div class="mkdf-blog-single-navigation-inner clearfix">
			<?php
				/* Single navigation section- SETTING PARAMS */
				$post_navigation = array(
					'prev' => array(
						'label' => '<span class="mkdf-blog-single-nav-label">'.esc_html__('Prev', 'biagiotti').'</span>'
					),
					'next' => array(
						'label' => '<span class="mkdf-blog-single-nav-label">'.esc_html__('Next', 'biagiotti').'</span>'
					)
				);
			
				if($blog_navigation_through_same_category){
					if(get_previous_post(true) !== ""){
						$post_navigation['prev']['post'] = get_previous_post(true);
					}
					if(get_next_post(true) !== ""){
						$post_navigation['next']['post'] = get_next_post(true);
					}
				} else {
					if(get_previous_post() !== ""){
						$post_navigation['prev']['post'] = get_previous_post();
					}
					if(get_next_post() !== ""){
						$post_navigation['next']['post'] = get_next_post();
					}
				}

				/* Single navigation section - RENDERING */
				foreach (array('prev', 'next') as $nav_type) {
					if (isset($post_navigation[$nav_type]['post'])) { ?>
						<span class="mkdf-blog-single-<?php echo esc_attr( $nav_type ); ?>">
							<?php if ( has_post_thumbnail( $post_navigation[ $nav_type ]['post']->ID ) ) {   ?>
								<a itemprop="url" class="mkdf-post-image" href="<?php echo get_permalink( $post_navigation[ $nav_type ]['post']->ID ); ?>">
									<?php echo biagiotti_mikado_generate_thumbnail ( get_post_thumbnail_id( $post_navigation[ $nav_type ]['post']->ID ), '', '101', '101' ) ?>
								</a>
							<?php } ?>
							
							<a itemprop="url" class="mkdf-post-nav"  href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
								<?php echo wp_kses($post_navigation[$nav_type]['label'], array('span' => array('class' => true))); ?>
							</a>
						</span>
					<?php }
				}
			?>
		</div>
	</div>
<?php } ?>