<?php

if ( ! function_exists( 'biagiotti_mikado_map_sidebar_meta' ) ) {
	function biagiotti_mikado_map_sidebar_meta() {
		$mkdf_sidebar_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'biagiotti_mikado_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'biagiotti' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'biagiotti' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'biagiotti' ),
				'parent'      => $mkdf_sidebar_meta_box,
				'options'     => biagiotti_mikado_get_custom_sidebars_options( true )
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_sidebar_center_widgets_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Center Widgets', 'biagiotti' ),
				'description'   => esc_html__( 'Choose YES to center widgets in sidebar', 'biagiotti' ),
				'parent'        => $mkdf_sidebar_meta_box,
				'default_value' => '',
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		$mkdf_custom_sidebars = biagiotti_mikado_get_custom_sidebars();
		if ( count( $mkdf_custom_sidebars ) > 0 ) {
			biagiotti_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'biagiotti' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'biagiotti' ),
					'parent'      => $mkdf_sidebar_meta_box,
					'options'     => $mkdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_map_sidebar_meta', 31 );
}