<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_standard_options' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_standard_map' ) ) {
	function biagiotti_mikado_header_standard_map( $parent ) {
		$hide_dep_options = biagiotti_mikado_get_hide_dep_for_header_standard_options();
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'biagiotti' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'biagiotti' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'biagiotti' ),
					'left'   => esc_html__( 'Left', 'biagiotti' ),
					'center' => esc_html__( 'Center', 'biagiotti' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_additional_header_menu_area_options_map', 'biagiotti_mikado_header_standard_map' );
}