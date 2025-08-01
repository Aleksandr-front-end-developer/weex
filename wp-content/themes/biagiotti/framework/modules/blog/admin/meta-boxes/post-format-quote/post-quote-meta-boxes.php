<?php

if ( ! function_exists( 'biagiotti_mikado_map_post_quote_meta' ) ) {
	function biagiotti_mikado_map_post_quote_meta() {
		$quote_post_format_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'biagiotti' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'biagiotti' ),
				'description' => esc_html__( 'Enter Quote text', 'biagiotti' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'biagiotti' ),
				'description' => esc_html__( 'Enter Quote author', 'biagiotti' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_map_post_quote_meta', 25 );
}