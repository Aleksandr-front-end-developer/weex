<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_top_header_area_meta_boxes' ) ) {
	function biagiotti_mikado_get_hide_dep_for_top_header_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_top_header_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_top_area_meta_options_map' ) ) {
	function biagiotti_mikado_header_top_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = biagiotti_mikado_get_hide_dep_for_top_header_area_meta_boxes();
		
		$top_header_container = biagiotti_mikado_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name'   => 'top_area_style',
				'title'  => esc_html__( 'Top Area', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_top_bar_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Top Bar', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will show header top bar area', 'biagiotti' ),
				'parent'        => $top_header_container,
				'options'       => biagiotti_mikado_get_yes_no_select_array(),
			)
		);
		
		$top_bar_container = biagiotti_mikado_add_admin_container_no_style(
			array(
				'name'            => 'top_bar_container_no_style',
				'parent'          => $top_header_container,
				'dependency' => array(
					'show' => array(
						'mkdf_top_bar_meta' => 'yes'
					)
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_top_bar_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar In Grid', 'biagiotti' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'biagiotti' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'   => 'mkdf_top_bar_background_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Top Bar Background Color', 'biagiotti' ),
				'parent' => $top_bar_container
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_top_bar_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Background Color Transparency', 'biagiotti' ),
				'description' => esc_html__( 'Set top bar background color transparenct. Value should be between 0 and 1', 'biagiotti' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_top_bar_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar Border', 'biagiotti' ),
				'description'   => esc_html__( 'Set border on top bar', 'biagiotti' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		$top_bar_border_container = biagiotti_mikado_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'dependency' => array(
					'show' => array(
						'mkdf_top_bar_border_meta' => 'yes'
					)
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_top_bar_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'biagiotti' ),
				'description' => esc_html__( 'Choose color for top bar border', 'biagiotti' ),
				'parent'      => $top_bar_border_container
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_additional_header_area_meta_boxes_map', 'biagiotti_mikado_header_top_area_meta_options_map' );
}