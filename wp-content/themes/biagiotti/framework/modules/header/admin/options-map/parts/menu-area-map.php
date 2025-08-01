<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_menu_area_options' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_menu_area_options() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_menu_area_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_menu_area_options_map' ) ) {
	function biagiotti_mikado_header_menu_area_options_map( $panel_header ) {
		$hide_dep_options = biagiotti_mikado_get_hide_dep_for_header_menu_area_options();
		
		$menu_area_container = biagiotti_mikado_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'menu_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				),
			)
		);
		
		biagiotti_mikado_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Menu Area Style', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area In Grid', 'biagiotti' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'biagiotti' ),
			)
		);
		
		$menu_area_in_grid_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_in_grid_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid'  => 'no'
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Color', 'biagiotti' ),
				'description'   => esc_html__( 'Set grid background color for menu area', 'biagiotti' ),
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Transparency', 'biagiotti' ),
				'description'   => esc_html__( 'Set grid background transparency for menu area', 'biagiotti' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Shadow', 'biagiotti' ),
				'description'   => esc_html__( 'Set shadow on grid area', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Border', 'biagiotti' ),
				'description'   => esc_html__( 'Set border on grid area', 'biagiotti' )
			)
		);
		
		$menu_area_in_grid_border_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_container,
				'name'            => 'menu_area_in_grid_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid_border'  => 'no'
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'biagiotti' ),
				'description'   => esc_html__( 'Set border color for menu area', 'biagiotti' ),
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'color',
				'name'          => 'menu_area_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Background Color', 'biagiotti' ),
				'description'   => esc_html__( 'Set background color for menu area', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'biagiotti' ),
				'description'   => esc_html__( 'Set background transparency for menu area', 'biagiotti' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Shadow', 'biagiotti' ),
				'description'   => esc_html__( 'Set shadow on menu area', 'biagiotti' ),
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'menu_area_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Border', 'biagiotti' ),
				'description'   => esc_html__( 'Set border on menu area', 'biagiotti' ),
				'parent'        => $menu_area_container
			)
		);
		
		$menu_area_border_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_border'  => 'no'
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'menu_area_border_color',
				'label'       => esc_html__( 'Border Color', 'biagiotti' ),
				'description' => esc_html__( 'Set border color for menu area', 'biagiotti' ),
				'parent'      => $menu_area_border_container
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'        => 'text',
				'name'        => 'menu_area_height',
				'label'       => esc_html__( 'Height', 'biagiotti' ),
				'description' => esc_html__( 'Enter header height', 'biagiotti' ),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'   => 'text',
				'name'   => 'menu_area_side_padding',
				'label'  => esc_html__( 'Menu Area Side Padding', 'biagiotti' ),
				'parent' => $menu_area_container,
				'args'   => array(
					'col_width' => 2,
					'suffix'    => esc_html__( 'px or %', 'biagiotti' )
				)
			)
		);
		
		do_action( 'biagiotti_mikado_header_menu_area_additional_options', $panel_header );
	}
	
	add_action( 'biagiotti_mikado_action_header_menu_area_options_map', 'biagiotti_mikado_header_menu_area_options_map', 10, 1 );
}