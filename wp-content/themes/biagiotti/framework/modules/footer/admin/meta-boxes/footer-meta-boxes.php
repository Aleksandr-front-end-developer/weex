<?php

if ( ! function_exists( 'biagiotti_mikado_map_footer_meta' ) ) {
	function biagiotti_mikado_map_footer_meta() {
		
		$footer_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'biagiotti_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'biagiotti' ),
				'name'  => 'footer_meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer For This Page', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'biagiotti' ),
				'options'       => biagiotti_mikado_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = biagiotti_mikado_add_admin_container(
			array(
				'name'       => 'mkdf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			biagiotti_mikado_create_meta_box_field(
				array(
					'name'          => 'mkdf_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'biagiotti' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'biagiotti' ),
					'options'       => biagiotti_mikado_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			biagiotti_mikado_create_meta_box_field(
				array(
					'name'          => 'mkdf_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'biagiotti' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'biagiotti' ),
					'options'       => biagiotti_mikado_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			biagiotti_mikado_create_meta_box_field(
				array(
					'name'          => 'mkdf_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'biagiotti' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'biagiotti' ),
					'options'       => biagiotti_mikado_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_top_styles_group = biagiotti_mikado_add_admin_group(
				array(
					'name'        => 'footer_top_styles_group',
					'title'       => esc_html__( 'Footer Top Styles', 'biagiotti' ),
					'description' => esc_html__( 'Define style for footer top area', 'biagiotti' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'mkdf_show_footer_top_meta' => 'no'
						)
					)
				)
			);
			
			$footer_top_styles_row_1 = biagiotti_mikado_add_admin_row(
				array(
					'name'   => 'footer_top_styles_row_1',
					'parent' => $footer_top_styles_group
				)
			);
		
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_top_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'biagiotti' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_top_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'biagiotti' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_top_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'biagiotti' ),
						'parent' => $footer_top_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
			
			biagiotti_mikado_create_meta_box_field(
				array(
					'name'          => 'mkdf_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'biagiotti' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'biagiotti' ),
					'options'       => biagiotti_mikado_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_bottom_styles_group = biagiotti_mikado_add_admin_group(
				array(
					'name'        => 'footer_bottom_styles_group',
					'title'       => esc_html__( 'Footer Bottom Styles', 'biagiotti' ),
					'description' => esc_html__( 'Define style for footer bottom area', 'biagiotti' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'mkdf_show_footer_bottom_meta' => 'no'
						)
					)
				)
			);
			
			$footer_bottom_styles_row_1 = biagiotti_mikado_add_admin_row(
				array(
					'name'   => 'footer_bottom_styles_row_1',
					'parent' => $footer_bottom_styles_group
				)
			);
			
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_bottom_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'biagiotti' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_bottom_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'biagiotti' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_bottom_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'biagiotti' ),
						'parent' => $footer_bottom_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_map_footer_meta', 70 );
}