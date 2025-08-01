<div class="mkdf-section-title-holder <?php echo esc_attr( $holder_classes ); ?>" <?php echo biagiotti_mikado_get_inline_style( $holder_styles ); ?>>
	<div class="mkdf-st-inner">
		<?php if ( ! empty( $image ) && $image_position === 'top' ) { ?>
			<span class="mkdf-st-image" <?php echo biagiotti_mikado_get_inline_style( $image_styles ); ?>>
				<?php echo wp_get_attachment_image($image['image_id'], 'full'); ?>
			</span>
		<?php } ?>
		<?php if ( ! empty( $tagline ) && $tagline_position === 'top') { ?>
			<<?php echo esc_attr( $tagline_tag ); ?> class="mkdf-st-tagline" <?php echo biagiotti_mikado_get_inline_style( $tagline_styles ); ?>>
				<?php echo wp_kses( $tagline, array( 'br' => true, 'span' => array( 'class' => true ) ) ); ?>
			</<?php echo esc_attr( $tagline_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $title ) ) { ?>
			<<?php echo esc_attr( $title_tag ); ?> class="mkdf-st-title" <?php echo biagiotti_mikado_get_inline_style( $title_styles ); ?>>
				<?php echo wp_kses( $title, array( 'br' => true, 'span' => array( 'class' => true ) ) ); ?>
			</<?php echo esc_attr( $title_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $subtitle ) ) { ?>
			<<?php echo esc_attr( $subtitle_tag ); ?> class="mkdf-st-subtitle" <?php echo biagiotti_mikado_get_inline_style( $subtitle_styles ); ?>>
				<?php echo wp_kses( $subtitle, array( 'br' => true ) ); ?>
			</<?php echo esc_attr( $subtitle_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $text ) ) { ?>
			<<?php echo esc_attr( $text_tag ); ?> class="mkdf-st-text" <?php echo biagiotti_mikado_get_inline_style( $text_styles ); ?>>
				<?php echo wp_kses( $text, array( 'br' => true ) ); ?>
			</<?php echo esc_attr( $text_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $tagline ) && $tagline_position === 'bottom') { ?>
			<<?php echo esc_attr( $tagline_tag ); ?> class="mkdf-st-tagline" <?php echo biagiotti_mikado_get_inline_style( $tagline_styles ); ?>>
			<?php echo wp_kses( $tagline, array( 'br' => true, 'span' => array( 'class' => true ) ) ); ?>
			</<?php echo esc_attr( $tagline_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $image ) && $image_position === 'bottom' ) { ?>
			<span class="mkdf-st-image" <?php echo biagiotti_mikado_get_inline_style( $image_styles ); ?>>
				<?php echo wp_get_attachment_image($image['image_id'], 'full'); ?>
			</span>
		<?php } ?>
		<?php if ( ! empty( $button_parameters ) ) { ?>
			<div class="mkdf-st-button"><?php echo biagiotti_mikado_get_button_html( $button_parameters ); ?></div>
		<?php } ?>
	</div>
</div>