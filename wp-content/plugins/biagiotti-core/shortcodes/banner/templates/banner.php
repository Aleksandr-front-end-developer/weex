<div class="mkdf-banner-holder <?php echo esc_attr($holder_classes); ?>">

	<?php if(!empty($image)) { ?>
	    <div class="mkdf-banner-image">
	        <?php echo wp_get_attachment_image($image, 'full'); ?>
	    </div>
	<?php } else { ?>
		<div class="mkdf-banner-bg-color"></div>
	<?php } ?>
    <div class="mkdf-banner-text-holder" <?php echo biagiotti_mikado_get_inline_style($overlay_styles); ?>>
	    <div class="mkdf-banner-text-outer">
		    <div class="mkdf-banner-text-inner">
		        <?php if(!empty($custom_title)) { ?>
		            <<?php echo esc_attr($custom_title_tag); ?> class="mkdf-banner-custom-title" <?php echo biagiotti_mikado_get_inline_style($custom_title_styles); ?>>
			            <?php echo esc_html($custom_title); ?>
		            </<?php echo esc_attr($custom_title_tag); ?>>
		        <?php } ?>
		        <?php if(!empty($title)) { ?>
		            <<?php echo esc_attr($title_tag); ?> class="mkdf-banner-title" <?php echo biagiotti_mikado_get_inline_style($title_styles); ?>>
		                <?php echo wp_kses($title, array('span' => array('class' => true))); ?>
	                </<?php echo esc_attr($title_tag); ?>>
		        <?php } ?>
	            <?php if(!empty($subtitle)) { ?>
				    <<?php echo esc_attr($subtitle_tag); ?> class="mkdf-banner-subtitle" <?php echo biagiotti_mikado_get_inline_style($subtitle_styles); ?>>
					    <?php echo esc_html($subtitle); ?>
				    </<?php echo esc_attr($subtitle_tag); ?>>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php if (!empty($link)) { ?>
        <a itemprop="url" class="mkdf-banner-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
    <?php } ?>
</div>