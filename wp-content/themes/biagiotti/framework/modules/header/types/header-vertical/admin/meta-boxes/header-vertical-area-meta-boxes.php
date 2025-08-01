<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_vertical_area_meta_boxes' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_vertical_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_vertical_hide_meta_boxes', $hide_dep_options = array( '' => '' ) );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_vertical_area_meta_options_map' ) ) {
	function biagiotti_mikado_header_vertical_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = biagiotti_mikado_get_hide_dep_for_header_vertical_area_meta_boxes();
		
		$header_vertical_area_meta_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta' => $hide_dep_options
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name'   => 'vertical_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_vertical_header_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'biagiotti' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'biagiotti' ),
				'parent'      => $header_vertical_area_meta_container
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'biagiotti' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'biagiotti' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Background Image', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'biagiotti' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_vertical_header_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Shadow', 'biagiotti' ),
				'description'   => esc_html__( 'Set shadow on vertical menu', 'biagiotti' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_vertical_header_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical Area Border', 'biagiotti' ),
				'description'   => esc_html__( 'Set border on vertical area', 'biagiotti' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		$vertical_header_border_container = biagiotti_mikado_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'vertical_header_border_container',
				'parent'          => $header_vertical_area_meta_container,
				'dependency' => array(
					'show' => array(
						'mkdf_vertical_header_border_meta'  => 'yes'
					)
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_vertical_header_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'biagiotti' ),
				'description' => esc_html__( 'Choose color of border', 'biagiotti' ),
				'parent'      => $vertical_header_border_container
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_vertical_header_center_content_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Center Content', 'biagiotti' ),
				'description'   => esc_html__( 'Set content in vertical center', 'biagiotti' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_additional_header_area_meta_boxes_map', 'biagiotti_mikado_header_vertical_area_meta_options_map' );
}