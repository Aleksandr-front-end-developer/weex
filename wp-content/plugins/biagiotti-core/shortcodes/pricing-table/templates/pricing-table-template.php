<div class="mkdf-price-table mkdf-item-space <?php echo esc_attr( $holder_classes ); ?>">
	<div class="mkdf-pt-inner" <?php echo biagiotti_mikado_get_inline_style( $holder_styles ); ?>>
		<ul>
			<li class="mkdf-pt-title-holder">
				<span class="mkdf-pt-title" <?php echo biagiotti_mikado_get_inline_style( $title_styles ); ?>><?php echo esc_html( $title ); ?></span>
			</li>
			<li class="mkdf-pt-prices">
				<span class="mkdf-pt-value" <?php echo biagiotti_mikado_get_inline_style( $currency_styles ); ?>><?php echo esc_html( $currency ); ?></span>
				<span class="mkdf-pt-price" <?php echo biagiotti_mikado_get_inline_style( $price_styles ); ?>><?php echo esc_html( $price ); ?></span>
				<span class="mkdf-pt-mark" <?php echo biagiotti_mikado_get_inline_style( $price_period_styles ); ?>><?php echo esc_html( $price_period ); ?></span>
			</li>
			<li class="mkdf-pt-content">
				<?php echo do_shortcode( $content ); ?>
			</li>
			<?php
			if ( ! empty( $button_text ) ) { ?>
				<li class="mkdf-pt-button">
					<?php echo biagiotti_mikado_get_button_html( array(
						'link'         => $link,
						'target'       => $target,
						'text'         => $button_text,
						'type'         => $button_type,
						'size'         => 'large',
						'custom_class' => 'mkdf-btn-with-prefix'
					) ); ?>
				</li>
			<?php } ?>
			<li class="mkdf-pt-active-content">
				<span class="mkdf-pt-active-text"><?php echo esc_html( $active_custom_text ); ?></span>
			</li>
		</ul>
	</div>
</div>