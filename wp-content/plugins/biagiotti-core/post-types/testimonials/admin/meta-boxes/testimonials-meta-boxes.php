<?php

if ( ! function_exists( 'biagiotti_core_map_testimonials_meta' ) ) {
	function biagiotti_core_map_testimonials_meta() {
		$testimonial_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'biagiotti-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_tagline',
				'type'        => 'text',
				'label'       => esc_html__( 'Tagline', 'biagiotti-core' ),
				'description' => esc_html__( 'Enter testemonials tagline', 'biagiotti-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'biagiotti-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'biagiotti-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'biagiotti-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'biagiotti-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'biagiotti-core' ),
				'description' => esc_html__( 'Enter author name', 'biagiotti-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'biagiotti-core' ),
				'description' => esc_html__( 'Enter author job position', 'biagiotti-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_core_map_testimonials_meta', 95 );
}