<?php

if ( ! function_exists( 'biagiotti_core_reviews_map' ) ) {
	function biagiotti_core_reviews_map() {
		
		$reviews_panel = biagiotti_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'biagiotti-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'biagiotti-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'biagiotti-core' ),
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'biagiotti-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'biagiotti-core' ),
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_additional_page_options_map', 'biagiotti_core_reviews_map', 75 ); //one after elements
}