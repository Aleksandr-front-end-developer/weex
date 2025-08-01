<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_logo_area_options' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_logo_area_options() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_logo_area_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_logo_area_options_map' ) ) {
	function biagiotti_mikado_header_logo_area_options_map( $panel_header ) {
		$hide_dep_options = biagiotti_mikado_get_hide_dep_for_header_logo_area_options();
		
		$logo_area_container = biagiotti_mikado_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'logo_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name'   => 'logo_menu_area_title',
				'title'  => esc_html__( 'Logo Area', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Logo Area In Grid', 'biagiotti' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'biagiotti' )
			)
		);
		
		$logo_area_in_grid_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'     => $logo_area_container,
                'name'       => 'logo_area_in_grid_container',
				'dependency' => array(
					'hide' => array(
						'logo_area_in_grid' => 'no'
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_container,
				'type'          => 'color',
				'name'          => 'logo_area_grid_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Color', 'biagiotti' ),
				'description'   => esc_html__( 'Set grid background color for logo area', 'biagiotti' ),
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_container,
				'type'          => 'text',
				'name'          => 'logo_area_grid_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Transparency', 'biagiotti' ),
				'description'   => esc_html__( 'Set grid background transparency', 'biagiotti' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Border', 'biagiotti' ),
				'description'   => esc_html__( 'Set border on grid area', 'biagiotti' )
			)
		);
		
		$logo_area_in_grid_border_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $logo_area_in_grid_container,
				'name'            => 'logo_area_in_grid_border_container',
				'dependency' => array(
					'hide' => array(
						'logo_area_in_grid_border'  => 'no'
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'      => $logo_area_in_grid_border_container,
				'type'        => 'color',
				'name'        => 'logo_area_in_grid_border_color',
				'label'       => esc_html__( 'Border Color', 'biagiotti' ),
				'description' => esc_html__( 'Set border color for grid area', 'biagiotti' ),
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'      => $logo_area_container,
				'type'        => 'color',
				'name'        => 'logo_area_background_color',
				'label'       => esc_html__( 'Background Color', 'biagiotti' ),
				'description' => esc_html__( 'Set background color for logo area', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'text',
				'name'          => 'logo_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'biagiotti' ),
				'description'   => esc_html__( 'Set background transparency for logo area', 'biagiotti' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Logo Area Border', 'biagiotti' ),
				'description'   => esc_html__( 'Set border on logo area', 'biagiotti' )
			)
		);
		
		$logo_area_border_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $logo_area_container,
				'name'            => 'logo_area_border_container',
				'dependency' => array(
					'hide' => array(
						'logo_area_border'  => 'no'
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'color',
				'name'          => 'logo_area_border_color',
				'label'         => esc_html__( 'Border Color', 'biagiotti' ),
				'description'   => esc_html__( 'Set border color for logo area', 'biagiotti' ),
				'parent'        => $logo_area_border_container
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'logo_area_height',
				'label'         => esc_html__( 'Height', 'biagiotti' ),
				'description'   => esc_html__( 'Enter logo area height (default is 90px)', 'biagiotti' ),
				'parent'        => $logo_area_container,
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		do_action( 'biagiotti_mikado_header_logo_area_additional_options', $logo_area_container );
	}
	
	add_action( 'biagiotti_mikado_action_header_logo_area_options_map', 'biagiotti_mikado_header_logo_area_options_map', 10, 1 );
}