<?php

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_widget_areas_meta_boxes' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_widget_areas_meta_boxes() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_widget_areas_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_widget_area_one_meta_boxes' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_widget_area_one_meta_boxes() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_widget_area_one_hide_meta_boxes', $hide_dep_options = array() );

		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_hide_dep_for_header_widget_area_two_meta_boxes' ) ) {
	function biagiotti_mikado_get_hide_dep_for_header_widget_area_two_meta_boxes() {
		$hide_dep_options = apply_filters( 'biagiotti_mikado_filter_header_widget_area_two_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_widget_areas_meta_options_map' ) ) {
	function biagiotti_mikado_header_widget_areas_meta_options_map( $header_meta_box ) {
		$hide_dep_widgets 			= biagiotti_mikado_get_hide_dep_for_header_widget_areas_meta_boxes();
		$hide_dep_widget_area_one 	= biagiotti_mikado_get_hide_dep_for_header_widget_area_one_meta_boxes();
		$hide_dep_widget_area_two 	= biagiotti_mikado_get_hide_dep_for_header_widget_area_two_meta_boxes();

		$header_widget_areas_container = biagiotti_mikado_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_widget_areas_container',
				'parent'     => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta' => $hide_dep_widgets
					)
				),
				'args'       => array(
					'enable_panels_for_default_value' => true
				)
			)
		);
		
		biagiotti_mikado_add_admin_section_title(
			array(
				'parent' => $header_widget_areas_container,
				'name'   => 'header_widget_areas',
				'title'  => esc_html__( 'Widget Areas', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_disable_header_widget_areas_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Widget Areas', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will hide widget areas from header', 'biagiotti' ),
				'parent'        => $header_widget_areas_container,
			)
		);

		$header_custom_widget_areas_container = biagiotti_mikado_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_custom_widget_areas_container',
				'parent'     => $header_widget_areas_container,
				'dependency' => array(
					'hide' => array(
						'mkdf_disable_header_widget_areas_meta' => 'yes'
					)
				)
			)
		);
					
		$biagiotti_custom_sidebars = biagiotti_mikado_get_custom_sidebars();
		if ( count( $biagiotti_custom_sidebars ) > 0 ) {
			biagiotti_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_header_widget_area_one_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area One', 'biagiotti' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'biagiotti' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $biagiotti_custom_sidebars,
					'dependency' => array(
						'hide' => array(
							'mkdf_header_type_meta' => $hide_dep_widget_area_one
						)
					)
				)
			);
		}

		if ( count( $biagiotti_custom_sidebars ) > 0 ) {
			biagiotti_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_header_widget_area_two_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area Two', 'biagiotti' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'biagiotti' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $biagiotti_custom_sidebars,
					'dependency' => array(
						'hide' => array(
							'mkdf_header_type_meta' => $hide_dep_widget_area_two
						)
					)
				)
			);
		}
		
		do_action( 'biagiotti_mikado_header_widget_areas_additional_meta_boxes_map', $header_widget_areas_container );
	}
	
	add_action( 'biagiotti_mikado_action_header_widget_areas_meta_boxes_map', 'biagiotti_mikado_header_widget_areas_meta_options_map', 10, 1 );
}