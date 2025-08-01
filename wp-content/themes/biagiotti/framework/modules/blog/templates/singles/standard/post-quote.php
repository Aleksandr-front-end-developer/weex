<?php
$image_size      = isset( $image_size ) ? $image_size : 'full';
$bg_image_styles = array();

if (has_post_thumbnail()) {
	$bg_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );

	$bg_image_styles[] = 'background-image: url(' . $bg_image_url[0] . ')';
	$bg_image_styles[] = 'background-repeat: no-repeat';
	$bg_image_styles[] = 'background-size: cover';
	$bg_image_styles[] = 'background-position-x: right';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-text mkdf-post-heading">
            <div class="mkdf-post-text-inner" <?php echo biagiotti_mikado_get_inline_style($bg_image_styles); ?>>
	            <div class="mkdf-post-text-main">
		            <div class="mkdf-post-mark">
			            <span class="mkdf-quote-mark"><?php echo biagiotti_mikado_get_quote_icon_svg(); ?></span>
		            </div>
		            <?php biagiotti_mikado_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
	            </div>
            </div>
        </div>
    </div>
    <div class="mkdf-post-additional-content">
        <?php the_content(); ?>
    </div>
</article>

