<?php

if ( ! function_exists( 'biagiotti_mikado_woocommerce_yith_template_single_title' ) ) {
	/**
	 * Function for overriding product title template in YITH Quick View plugin template
	 */
	function biagiotti_mikado_woocommerce_yith_template_single_title() {
		the_title( '<h2  itemprop="name" class="mkdf-yith-product-title entry-title">', '</h2>' );
	}
}

if ( ! function_exists( 'biagiotti_mikado_woocommerce_yith_qcv_single_link_label' ) ) {
	function biagiotti_mikado_woocommerce_yith_qcv_single_link_label() {
		$product = wc_get_product( get_the_ID() );

		if ( ! empty( $product ) ) {
			$button_params = array(
				'type' => 'simple',
				'link' => get_permalink( $product->get_id() ),
				'text' => esc_html__( 'View full details', 'biagiotti' ),
				'custom_class' => 'mkdf-product-single-link'
			);

			echo biagiotti_mikado_return_button_html( $button_params );
		}
	}
}