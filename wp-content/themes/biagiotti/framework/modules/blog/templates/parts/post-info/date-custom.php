<?php
$month = get_the_time('M');
$year = get_the_time('Y');
$date = get_the_time('d');
$title = get_the_title();
?>
<div itemprop="dateCreated" class="mkdf-post-info-date entry-date published updated">
	<?php if(empty($title) && biagiotti_mikado_blog_item_has_link()) { ?>
	<a itemprop="url" href="<?php the_permalink() ?>">
		<?php } else { ?>
		<a itemprop="url" href="<?php echo get_month_link($year, $month); ?>">
			<?php } ?>
			<span class="mkdf-post-info-get-month"><?php echo biagiotti_mikado_get_module_part($month); ?></span>
			<span class="mkdf-post-info-get-date"><?php echo biagiotti_mikado_get_module_part($date); ?></span>
		</a>
		<meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(biagiotti_mikado_get_page_id()); ?>"/>
</div>