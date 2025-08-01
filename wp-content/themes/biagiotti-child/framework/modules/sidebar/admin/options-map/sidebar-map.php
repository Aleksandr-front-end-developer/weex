<?php

if ( ! function_exists( 'biagiotti_mikado_sidebar_options_map' ) ) {
	function biagiotti_mikado_sidebar_options_map() {
		
		biagiotti_mikado_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'biagiotti' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = biagiotti_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'biagiotti' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		biagiotti_mikado_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'biagiotti' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'biagiotti' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => biagiotti_mikado_get_custom_sidebars_options()
		) );
		
		biagiotti_mikado_add_admin_field( array(
			'name'          => 'sidebar_center_widgets',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Center Widgets', 'biagiotti' ),
			'description'   => esc_html__( 'Choose YES to center widgets in sidebar', 'biagiotti' ),
			'parent'        => $sidebar_panel,
			'default_value' => '',
			'options'       => biagiotti_mikado_get_yes_no_select_array()
		) );
		
		$biagiotti_custom_sidebars = biagiotti_mikado_get_custom_sidebars();
		if ( count( $biagiotti_custom_sidebars ) > 0 ) {
			biagiotti_mikado_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'biagiotti' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'biagiotti' ),
				'parent'      => $sidebar_panel,
				'options'     => $biagiotti_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'biagiotti_mikado_action_options_map', 'biagiotti_mikado_sidebar_options_map', biagiotti_mikado_set_options_map_position( 'sidebar' ) );
}