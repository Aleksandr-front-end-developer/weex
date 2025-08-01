<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_standard_meta_map' ) ) {
	function biagiotti_mikado_header_standard_meta_map( $parent ) {
		$hide_dep_options = biagiotti_mikado_get_hide_dep_for_header_standard_meta_boxes();
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'mkdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'biagiotti' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'biagiotti' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'biagiotti' ),
					'left'   => esc_html__( 'Left', 'biagiotti' ),
					'right'  => esc_html__( 'Right', 'biagiotti' ),
					'center' => esc_html__( 'Center', 'biagiotti' )
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_additional_header_area_meta_boxes_map', 'biagiotti_mikado_header_standard_meta_map' );
}