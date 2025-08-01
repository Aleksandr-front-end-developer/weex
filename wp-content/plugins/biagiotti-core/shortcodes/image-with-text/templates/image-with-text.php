<div class="mkdf-image-with-text-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-iwt-image">
        <?php if ($image_behavior === 'lightbox') { ?>
            <a itemprop="image" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[iwt_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
        <?php } else if ($image_behavior === 'custom-link' && !empty($custom_link)) { ?>
	            <a itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
        <?php } ?>
            <?php if($image_behavior === '' && ($image_link_text1 !== '' || $image_link_text2 !== '')) {?>
                <div class="mkdf-iwt-image-links" <?php echo biagiotti_mikado_get_inline_style($image_links_holder_styles); ?>>
                    <?php if($image_link_text1 !== ''){ ?>
                        <a class="mkdf-h6" itemprop="url" href="<?php echo esc_url($image_link1); ?>" target="<?php echo esc_attr($image_link_target1); ?>"><?php echo esc_html($image_link_text1); ?></a>
                    <?php } ?>
                    <?php if($image_link_text2 !== ''){ ?>
                        <a class="mkdf-h6" itemprop="url" href="<?php echo esc_url($image_link2); ?>" target="<?php echo esc_attr($image_link_target2); ?>"><?php echo esc_html($image_link_text2); ?></a>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if(is_array($image_size) && count($image_size)) : ?>
                <?php echo biagiotti_mikado_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
        <?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
            </a>
        <?php } ?>
    </div>
    <div class="mkdf-iwt-text-holder">
        <?php if(!empty($tagline)) { ?>
            <<?php echo esc_attr($tagline_tag); ?> class="mkdf-iwt-tagline" <?php echo biagiotti_mikado_get_inline_style($tagline_styles); ?>><?php echo esc_html($tagline); ?></<?php echo esc_attr($tagline_tag); ?>>
        <?php } ?>
		<?php if(!empty($title)) { ?>
            <<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-title" <?php echo biagiotti_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        <?php } ?>
		<?php if(!empty($text)) { ?>
            <p class="mkdf-iwt-text" <?php echo biagiotti_mikado_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
        <?php } ?>
    </div>
</div>