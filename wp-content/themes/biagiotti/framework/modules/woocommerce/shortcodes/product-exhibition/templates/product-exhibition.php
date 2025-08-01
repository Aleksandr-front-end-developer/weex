<div class="mkdf-product-exhibition <?php echo esc_attr( $holder_classes ) ?>">
	<?php if ($orientation=='right') { ?>
		<div class="mkdf-pe-product-list">
			<?php echo biagiotti_mikado_get_product_list_html( $params ); ?>
		</div>
		<div class="mkdf-pe-background">
			<div class="mkdf-pe-background-image-holder">
				<div class="mkdf-pe-background-image" <?php echo biagiotti_mikado_get_inline_style($main_section_bg_styles); ?>></div>
				<div class="mkdf-pe-main-info">
					<?php if ( ! empty( $tagline ) ) { ?>
					<<?php echo esc_attr( $tagline_tag ); ?> class="mkdf-pe-tagline" <?php echo biagiotti_mikado_get_inline_style( $tagline_styles ); ?>>
					<?php echo esc_html( $tagline ); ?>
					</<?php echo esc_attr( $tagline_tag ); ?>>
					<?php } ?>
					<?php if ( ! empty( $main_title ) ) { ?>
					<<?php echo esc_attr( $main_title_tag ); ?> class="mkdf-pe-title">
					<?php echo esc_html( $main_title ); ?>
					</<?php echo esc_attr( $main_title_tag ); ?>>
					<?php } ?>
				</div>
				<?php if (!empty($link)) { ?>
					<a itemprop="url" class="mkdf-pe-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
				<?php } ?>
			</div>
		</div>
	<?php } else { ; ?>
		<div class="mkdf-pe-background">
			<div class="mkdf-pe-background-image-holder">
				<div class="mkdf-pe-background-image" <?php echo biagiotti_mikado_get_inline_style($main_section_bg_styles); ?>></div>
				<div class="mkdf-pe-main-info">
					<?php if ( ! empty( $tagline ) ) { ?>
					<<?php echo esc_attr( $tagline_tag ); ?> class="mkdf-pe-tagline" <?php echo biagiotti_mikado_get_inline_style( $tagline_styles ); ?>>
					<?php echo esc_html( $tagline ); ?>
				</<?php echo esc_attr( $tagline_tag ); ?>>
				<?php } ?>
				<?php if ( ! empty( $main_title ) ) { ?>
				<<?php echo esc_attr( $main_title_tag ); ?> class="mkdf-pe-title">
				<?php echo esc_html( $main_title ); ?>
			</<?php echo esc_attr( $main_title_tag ); ?>>
			<?php } ?>
		</div>
		<?php if (!empty($link)) { ?>
			<a itemprop="url" class="mkdf-pe-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
		<?php } ?>
		</div>
		</div>
		<div class="mkdf-pe-product-list">
			<?php echo biagiotti_mikado_get_product_list_html( $params ); ?>
		</div>
	<?php } ?>
</div>

