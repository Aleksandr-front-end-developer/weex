<?php if(comments_open()) { ?>
	<div class="mkdf-post-info-comments-holder">
		<a itemprop="url" class="mkdf-post-info-comments" href="<?php comments_link(); ?>">
			<?php comments_number('0 ' . esc_html__('Comments','biagiotti'), '1 '.esc_html__('Comment','biagiotti'), '% '.esc_html__('Comments','biagiotti') ); ?>
		</a>
	</div>
<?php } ?>