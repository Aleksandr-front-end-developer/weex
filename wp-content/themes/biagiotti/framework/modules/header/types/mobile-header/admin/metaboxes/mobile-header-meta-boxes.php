<?php

if ( ! function_exists( 'biagiotti_mikado_mobile_menu_meta_box_map' ) ) {
	function biagiotti_mikado_mobile_menu_meta_box_map($header_meta_box) {

		biagiotti_mikado_add_admin_section_title(
			array(
				'parent' => $header_meta_box,
				'name'   => 'header_mobile',
				'title'  => esc_html__( 'Mobile Header in Grid', 'biagiotti' )
			)
		);

		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_mobile_header_in_grid_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Mobile Header in Grid', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will put mobile header in grid', 'biagiotti' ),
				'parent'        => $header_meta_box,
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);

		$mobile_header_without_grid_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'mobile_header_without_grid_container',
				'dependency' => array(
					'show' => array(
						'mkdf_mobile_header_in_grid_meta' => 'no'
					)
				)
			)
		);

		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_mobile_header_without_grid_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Header Padding', 'biagiotti' ),
				'description' => esc_html__( 'Set padding for Mobile Header', 'biagiotti' ),
				'parent'      => $mobile_header_without_grid_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);


	}
	
	add_action( 'biagiotti_mikado_action_header_mobile_menu_meta_boxes_map', 'biagiotti_mikado_mobile_menu_meta_box_map', 10 );
}