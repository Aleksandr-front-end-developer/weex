<?php

if ( ! function_exists( 'biagiotti_mikado_map_post_link_meta' ) ) {
	function biagiotti_mikado_map_post_link_meta() {
		$link_post_format_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'biagiotti' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'biagiotti' ),
				'description' => esc_html__( 'Enter link', 'biagiotti' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_map_post_link_meta', 24 );
}