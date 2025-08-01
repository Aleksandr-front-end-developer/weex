<div class="mkdf-eh-item <?php echo esc_attr($holder_classes); ?>" <?php echo biagiotti_mikado_get_inline_attrs($holder_data); ?>>
	<div class="mkdf-eh-background-holder" <?php echo biagiotti_mikado_get_inline_style($holder_styles); ?> ></div>
	<div class="mkdf-eh-item-inner">
		<div class="mkdf-eh-item-content <?php echo esc_attr($holder_rand_class); ?>" <?php echo biagiotti_mikado_get_inline_style($content_styles); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
		<?php if (!empty($link)) { ?>
			<a itemprop="url" class="mkdf-holder-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
		<?php } ?>
	</div>
</div>