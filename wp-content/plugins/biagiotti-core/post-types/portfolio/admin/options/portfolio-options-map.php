<?php

if ( ! function_exists( 'biagiotti_mikado_portfolio_options_map' ) ) {
	function biagiotti_mikado_portfolio_options_map() {
		
		biagiotti_mikado_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'biagiotti-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = biagiotti_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'biagiotti-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'biagiotti-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'biagiotti-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'biagiotti-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'biagiotti-core' ),
				'parent'        => $panel_archive,
				'options'       => biagiotti_mikado_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'biagiotti-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'biagiotti-core' ),
				'default_value' => 'normal',
				'options'       => biagiotti_mikado_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'biagiotti-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'biagiotti-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'biagiotti-core' ),
					'landscape' => esc_html__( 'Landscape', 'biagiotti-core' ),
					'portrait'  => esc_html__( 'Portrait', 'biagiotti-core' ),
					'square'    => esc_html__( 'Square', 'biagiotti-core' )
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'biagiotti-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'biagiotti-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader'        => esc_html__( 'Standard - Shader', 'biagiotti-core' ),
					'standard-switch-images' => esc_html__( 'Standard - Switch Featured Images', 'biagiotti-core' ),
					'gallery-overlay'        => esc_html__( 'Gallery - Overlay', 'biagiotti-core' )
				)
			)
		);
		
		$panel = biagiotti_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'biagiotti-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'biagiotti-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'biagiotti-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'biagiotti-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'biagiotti-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => biagiotti_mikado_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'biagiotti-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'biagiotti-core' ),
				'default_value' => 'normal',
				'options'       => biagiotti_mikado_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'biagiotti-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'biagiotti-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => biagiotti_mikado_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'biagiotti-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'biagiotti-core' ),
				'default_value' => 'normal',
				'options'       => biagiotti_mikado_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'biagiotti-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'biagiotti-core' ),
					'yes' => esc_html__( 'Yes', 'biagiotti-core' ),
					'no'  => esc_html__( 'No', 'biagiotti-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'biagiotti-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'biagiotti-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'biagiotti-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'biagiotti-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'biagiotti-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'biagiotti-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'biagiotti-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = biagiotti_mikado_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'biagiotti-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'biagiotti-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'biagiotti-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'biagiotti-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_options_map', 'biagiotti_mikado_portfolio_options_map', biagiotti_mikado_set_options_map_position( 'portfolio' ) );
}