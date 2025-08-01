<?php

if ( ! function_exists( 'biagiotti_mikado_map_woocommerce_meta' ) ) {
	function biagiotti_mikado_map_woocommerce_meta() {
		
		$woocommerce_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'biagiotti' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'biagiotti' ),
				'description' => esc_html__( 'Choose image layout when it appears in Mikado Product List - Masonry layout shortcode', 'biagiotti' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'biagiotti' ),
					'small'              => esc_html__( 'Small', 'biagiotti' ),
					'large-width'        => esc_html__( 'Large Width', 'biagiotti' ),
					'large-height'       => esc_html__( 'Large Height', 'biagiotti' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'biagiotti' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'biagiotti' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'biagiotti' ),
				'options'       => biagiotti_mikado_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'biagiotti' ),
				'parent'        => $woocommerce_meta_box
			)
		);

		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_woo_product_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Product List Image', 'biagiotti' ),
				'description' => esc_html__( 'Choose an Image for displaying in product list shortcode. If not uploaded, product image will be shown.', 'biagiotti' ),
				'parent'      => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_map_woocommerce_meta', 99 );
}