<?php
$image_size         = isset( $image_size ) ? $image_size : 'full';
$image_meta         = get_post_meta( get_the_ID(), 'mkdf_blog_list_featured_image_meta', true );
$has_featured       = ! empty( $image_meta ) || has_post_thumbnail();
$blog_list_image_id = ! empty( $image_meta ) ? biagiotti_mikado_get_attachment_id_from_url( $image_meta ) : '';

$bg_image_styles = array();

if ($has_featured) {

	if ( ! empty( $blog_list_image_id ) ) {
		$bg_image_url = wp_get_attachment_image_src( $blog_list_image_id, $image_size );
	} else {
		$bg_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );
	}

	$bg_image_styles[] = 'background-image: url(' . $bg_image_url[0] . ')';
	$bg_image_styles[] = 'background-repeat: no-repeat';
	$bg_image_styles[] = 'background-size: cover';
	$bg_image_styles[] = 'background-position-x: right';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner" <?php echo biagiotti_mikado_get_inline_style($bg_image_styles); ?>>
                <div class="mkdf-post-text-main">
                    <div class="mkdf-post-mark">
	                    <span class="mkdf-link-mark"><?php echo biagiotti_mikado_get_link_icon_svg(); ?></span>
                    </div>
                    <?php biagiotti_mikado_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>
