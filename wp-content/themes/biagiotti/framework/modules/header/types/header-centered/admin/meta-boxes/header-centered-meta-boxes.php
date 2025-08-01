<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_centered_meta_boxes' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_centered_meta_boxes() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_centered_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_centered_meta_map' ) ) {
	function biagiotti_mikado_header_centered_meta_map( $parent ) {
		$hide_dep_options = biagiotti_mikado_get_hide_dep_for_header_centered_meta_boxes();
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'text',
				'name'            => 'mkdf_logo_wrapper_padding_header_centered_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Logo Padding', 'biagiotti' ),
				'description'     => esc_html__( 'Insert padding in format: 0px 0px 1px 0px', 'biagiotti' ),
				'args'            => array(
					'col_width' => 3
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_header_logo_area_additional_meta_boxes_map', 'biagiotti_mikado_header_centered_meta_map', 10, 1 );
}