<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_logo_area_meta_boxes' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_logo_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_logo_area_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}


if ( ! function_exists( 'biagiotti_mikado_header_logo_area_meta_options_map' ) ) {
	function biagiotti_mikado_header_logo_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = biagiotti_mikado_get_hide_dep_for_header_logo_area_meta_boxes();
		
		$logo_area_container = biagiotti_mikado_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_container',
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
				'parent' => $logo_area_container,
				'name'   => 'logo_area_style',
				'title'  => esc_html__( 'Logo Area Style', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_logo_area_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area In Grid', 'biagiotti' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'biagiotti' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		$logo_area_in_grid_container = biagiotti_mikado_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_container',
				'parent'          => $logo_area_container,
				'dependency' => array(
					'show' => array(
						'mkdf_logo_area_in_grid_meta'  => 'yes'
					)
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'biagiotti' ),
				'description' => esc_html__( 'Set grid background color for logo area', 'biagiotti' ),
				'parent'      => $logo_area_in_grid_container
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'biagiotti' ),
				'description' => esc_html__( 'Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'biagiotti' ),
				'parent'      => $logo_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_logo_area_in_grid_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Grid Area Border', 'biagiotti' ),
				'description'   => esc_html__( 'Set border on grid logo area', 'biagiotti' ),
				'parent'        => $logo_area_in_grid_container,
				'default_value' => '',
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		$logo_area_in_grid_border_container = biagiotti_mikado_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_border_container',
				'parent'          => $logo_area_in_grid_container,
				'dependency' => array(
					'show' => array(
						'mkdf_logo_area_in_grid_border_meta'  => 'yes'
					)
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_area_in_grid_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'biagiotti' ),
				'description' => esc_html__( 'Set border color for grid area', 'biagiotti' ),
				'parent'      => $logo_area_in_grid_border_container
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'biagiotti' ),
				'description' => esc_html__( 'Choose a background color for logo area', 'biagiotti' ),
				'parent'      => $logo_area_container
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Transparency', 'biagiotti' ),
				'description' => esc_html__( 'Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'biagiotti' ),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_logo_area_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area Border', 'biagiotti' ),
				'description'   => esc_html__( 'Set border on logo area', 'biagiotti' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		$logo_area_border_bottom_color_container = biagiotti_mikado_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_border_bottom_color_container',
				'parent'          => $logo_area_container,
				'dependency' => array(
					'show' => array(
						'mkdf_logo_area_border_meta'  => 'yes'
					)
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_area_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'biagiotti' ),
				'description' => esc_html__( 'Choose color of header bottom border', 'biagiotti' ),
				'parent'      => $logo_area_border_bottom_color_container
			)
		);

		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_area_height_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Height', 'biagiotti' ),
				'description' => esc_html__( 'Enter logo area height (default is 90px)', 'biagiotti' ),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => esc_html__( 'px', 'biagiotti' )
				)
			)
		);
		
		do_action( 'biagiotti_mikado_action_header_logo_area_additional_meta_boxes_map', $logo_area_container );
	}
	
	add_action( 'biagiotti_mikado_action_header_logo_area_meta_boxes_map', 'biagiotti_mikado_header_logo_area_meta_options_map', 10, 1 );
}