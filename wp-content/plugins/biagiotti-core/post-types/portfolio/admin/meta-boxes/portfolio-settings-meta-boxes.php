<?php

if ( ! function_exists( 'biagiotti_core_map_portfolio_settings_meta' ) ) {
	function biagiotti_core_map_portfolio_settings_meta() {
		$meta_box = biagiotti_mikado_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'biagiotti-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		biagiotti_mikado_create_meta_box_field( array(
			'name'        => 'mkdf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'biagiotti-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'biagiotti-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'biagiotti-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'biagiotti-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'biagiotti-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'biagiotti-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'biagiotti-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'biagiotti-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'biagiotti-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'biagiotti-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'biagiotti-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'biagiotti-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'biagiotti-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'biagiotti-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'mkdf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'mkdf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'biagiotti-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'biagiotti-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => biagiotti_mikado_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'biagiotti-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'biagiotti-core' ),
				'default_value' => '',
				'options'       => biagiotti_mikado_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'mkdf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'mkdf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'biagiotti-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'biagiotti-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => biagiotti_mikado_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'biagiotti-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'biagiotti-core' ),
				'default_value' => '',
				'options'       => biagiotti_mikado_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'biagiotti-core' ),
				'parent'        => $meta_box,
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'biagiotti-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'biagiotti-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'biagiotti-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'biagiotti-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'biagiotti-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'biagiotti-core' ),
				'parent'      => $meta_box
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'biagiotti-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'biagiotti-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'biagiotti-core' ),
					'small'              => esc_html__( 'Small', 'biagiotti-core' ),
					'large-width'        => esc_html__( 'Large Width', 'biagiotti-core' ),
					'large-height'       => esc_html__( 'Large Height', 'biagiotti-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'biagiotti-core' )
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'biagiotti-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'biagiotti-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'biagiotti-core' ),
					'large-width' => esc_html__( 'Large Width', 'biagiotti-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'biagiotti-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'biagiotti-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_core_map_portfolio_settings_meta', 41 );
}