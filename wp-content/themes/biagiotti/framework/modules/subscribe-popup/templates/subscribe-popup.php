<div class="mkdf-subscribe-popup-holder <?php echo esc_attr( $holder_classes ); ?>">
    <div class="mkdf-sp-table">
        <div class="mkdf-sp-table-cell">
            <div class="mkdf-sp-inner">
                <div class="mkdf-sp-content-container">
	                <a class="mkdf-sp-close" href="javascript:void(0)">
		                <?php echo biagiotti_mikado_close_popup_icon_svg(); ?>
	                </a>

	                <?php if ( ! empty( $subtitle ) ) { ?>
		                <div class="mkdf-sp-subtitle"><?php echo esc_html( $subtitle ); ?></div>
	                <?php } ?>
	                <?php if ( ! empty( $title ) ) { ?>
		                <h2 class="mkdf-sp-title"><?php echo esc_html( $title ); ?></h2>
	                <?php } ?>

                    <?php echo do_shortcode('[contact-form-7 id="' . $contact_form .'" html_class="'. $contact_form_style .'"]'); ?>

	                <?php if ( ! empty( $contact_form_description ) ) { ?>
		                <div class="mkdf-sp-form-description"><?php echo esc_html( $contact_form_description ); ?></div>
	                <?php } ?>

	                <?php if ( $enable_prevent === 'yes' ) { ?>
		                <div class="mkdf-sp-prevent">
			                <div class="mkdf-sp-prevent-inner">
				                <span class="mkdf-sp-prevent-input" data-value="no">
					                <label class="mkdf-sp-prevent-label">
						                <input name="mkdf-sp-prevent-input" value="1" id="mkdf-sp-prevent-input" type="checkbox" />
						                <?php esc_html_e( 'Prevent This Pop-up', 'biagiotti' ); ?>
					                </label>
				                </span>
			                </div>
		                </div>
	                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
