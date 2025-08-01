<?php

if ( ! function_exists( 'biagiotti_mikado_portfolio_category_additional_fields' ) ) {
	function biagiotti_mikado_portfolio_category_additional_fields() {
		
		$fields = biagiotti_mikado_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		biagiotti_mikado_add_taxonomy_field(
			array(
				'name'   => 'mkdf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'biagiotti-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_custom_taxonomy_fields', 'biagiotti_mikado_portfolio_category_additional_fields' );
}