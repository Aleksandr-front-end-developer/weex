<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_vertical_area_options' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_vertical_area_options() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_vertical_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_vertical_options_map' ) ) {
	function biagiotti_mikado_header_vertical_options_map( $panel_header ) {
		$hide_dep_options = biagiotti_mikado_get_hide_dep_for_header_vertical_area_options();
		
		$vertical_area_container = biagiotti_mikado_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_section_title(
			array(
				'parent' => $vertical_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'        => 'vertical_header_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'biagiotti' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'biagiotti' ),
				'parent'      => $vertical_area_container
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'vertical_header_background_image',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'biagiotti' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'biagiotti' ),
				'parent'        => $vertical_area_container
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Shadow', 'biagiotti' ),
				'description'   => esc_html__( 'Set shadow on vertical header', 'biagiotti' ),
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Vertical Area Border', 'biagiotti' ),
				'description'   => esc_html__( 'Set border on vertical area', 'biagiotti' )
			)
		);
		
		$vertical_header_shadow_border_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $vertical_area_container,
				'name'            => 'vertical_header_shadow_border_container',
				'dependency' => array(
					'hide' => array(
						'vertical_header_border'  => 'no'
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $vertical_header_shadow_border_container,
				'type'          => 'color',
				'name'          => 'vertical_header_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'biagiotti' ),
				'description'   => esc_html__( 'Set border color for vertical area', 'biagiotti' ),
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_center_content',
				'default_value' => 'no',
				'label'         => esc_html__( 'Center Content', 'biagiotti' ),
				'description'   => esc_html__( 'Set content in vertical center', 'biagiotti' ),
			)
		);
		
		do_action( 'biagiotti_mikado_header_vertical_area_additional_options', $panel_header );
	}
	
	add_action( 'biagiotti_mikado_action_additional_header_menu_area_options_map', 'biagiotti_mikado_header_vertical_options_map' );
}