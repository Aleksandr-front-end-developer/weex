<?php

if ( ! function_exists( 'biagiotti_mikado_footer_options_map' ) ) {
	function biagiotti_mikado_footer_options_map() {

		biagiotti_mikado_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'biagiotti' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = biagiotti_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'biagiotti' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'biagiotti' ),
				'parent'        => $footer_panel
			)
		);

        biagiotti_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'biagiotti' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'biagiotti' ),
                'parent'        => $footer_panel
            )
        );

		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'biagiotti' ),
				'parent'        => $footer_panel
			)
		);
		
		$show_footer_top_container = biagiotti_mikado_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'biagiotti' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'biagiotti' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'biagiotti' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'biagiotti' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'biagiotti' ),
					'left'   => esc_html__( 'Left', 'biagiotti' ),
					'center' => esc_html__( 'Center', 'biagiotti' ),
					'right'  => esc_html__( 'Right', 'biagiotti' )
				),
				'parent'        => $show_footer_top_container
			)
		);
		
		$footer_top_styles_group = biagiotti_mikado_add_admin_group(
			array(
				'name'        => 'footer_top_styles_group',
				'title'       => esc_html__( 'Footer Top Styles', 'biagiotti' ),
				'description' => esc_html__( 'Define style for footer top area', 'biagiotti' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		$footer_top_styles_row_1 = biagiotti_mikado_add_admin_row(
			array(
				'name'   => 'footer_top_styles_row_1',
				'parent' => $footer_top_styles_group
			)
		);
		
			biagiotti_mikado_add_admin_field(
				array(
					'name'   => 'footer_top_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'biagiotti' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			biagiotti_mikado_add_admin_field(
				array(
					'name'   => 'footer_top_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'biagiotti' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			biagiotti_mikado_add_admin_field(
				array(
					'name'   => 'footer_top_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'biagiotti' ),
					'parent' => $footer_top_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);

		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'biagiotti' ),
				'parent'        => $footer_panel
			)
		);

		$show_footer_bottom_container = biagiotti_mikado_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'biagiotti' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'biagiotti' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_spacing',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Spacing', 'biagiotti' ),
				'options'       => array(
					''        => esc_html__( 'Default', 'biagiotti' ),
					'compact' => esc_html__( 'Compact', 'biagiotti' )
				),
				'parent'        => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_group = biagiotti_mikado_add_admin_group(
			array(
				'name'        => 'footer_bottom_styles_group',
				'title'       => esc_html__( 'Footer Bottom Styles', 'biagiotti' ),
				'description' => esc_html__( 'Define style for footer bottom area', 'biagiotti' ),
				'parent'      => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_row_1 = biagiotti_mikado_add_admin_row(
			array(
				'name'   => 'footer_bottom_styles_row_1',
				'parent' => $footer_bottom_styles_group
			)
		);
		
			biagiotti_mikado_add_admin_field(
				array(
					'name'   => 'footer_bottom_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'biagiotti' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			biagiotti_mikado_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'biagiotti' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			biagiotti_mikado_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'biagiotti' ),
					'parent' => $footer_bottom_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);
	}

	add_action( 'biagiotti_mikado_action_options_map', 'biagiotti_mikado_footer_options_map', biagiotti_mikado_set_options_map_position( 'footer' ) );
}