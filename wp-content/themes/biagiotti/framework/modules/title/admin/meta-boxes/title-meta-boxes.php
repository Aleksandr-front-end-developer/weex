<?php

if ( ! function_exists( 'biagiotti_mikado_get_title_types_meta_boxes' ) ) {
	function biagiotti_mikado_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'biagiotti_mikado_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'biagiotti' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'biagiotti_mikado_map_title_meta' ) ) {
	function biagiotti_mikado_map_title_meta() {
		$title_type_meta_boxes = biagiotti_mikado_get_title_types_meta_boxes();
		
		$title_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'biagiotti_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'biagiotti' ),
				'name'  => 'title_meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'biagiotti' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'biagiotti' ),
				'parent'        => $title_meta_box,
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = biagiotti_mikado_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'mkdf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'mkdf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'biagiotti' ),
						'description'   => esc_html__( 'Choose title type', 'biagiotti' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'biagiotti' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'biagiotti' ),
						'options'       => biagiotti_mikado_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'biagiotti' ),
						'description' => esc_html__( 'Set a height for Title Area', 'biagiotti' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);

				biagiotti_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_height_mobile_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height on Mobile', 'biagiotti' ),
						'description' => esc_html__( 'Set a height for Title Area on Mobile', 'biagiotti' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'biagiotti' ),
						'description' => esc_html__( 'Choose a background color for title area', 'biagiotti' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'biagiotti' ),
						'description' => esc_html__( 'Choose an Image for title area', 'biagiotti' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'biagiotti' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'biagiotti' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'biagiotti' ),
							'hide'                => esc_html__( 'Hide Image', 'biagiotti' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'biagiotti' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'biagiotti' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'biagiotti' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'biagiotti' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'biagiotti' )
						)
					)
				);

				biagiotti_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_background_image_size_optimize_touch_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Enable Background Image Size Optimization on Touch Devices', 'biagiotti' ),
						'description'   => esc_html__( 'Enabling this option will optimize title area background image size for all touch devices', 'biagiotti' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''    => esc_html__( 'No', 'biagiotti' ),
							'yes' => esc_html__( 'Yes', 'biagiotti' )
						)
					)
				);
				
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'biagiotti' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'biagiotti' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'biagiotti' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'biagiotti' ),
							'window-top'    => esc_html__( 'From Window Top', 'biagiotti' )
						)
					)
				);
				
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'biagiotti' ),
						'options'       => biagiotti_mikado_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'biagiotti' ),
						'description' => esc_html__( 'Choose a color for title text', 'biagiotti' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'biagiotti' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'biagiotti' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'biagiotti' ),
						'options'       => biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				biagiotti_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'biagiotti' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'biagiotti' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'biagiotti_mikado_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_map_title_meta', 60 );
}