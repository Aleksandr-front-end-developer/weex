<?php

if ( ! function_exists( 'biagiotti_core_map_portfolio_meta' ) ) {
	function biagiotti_core_map_portfolio_meta() {
		global $biagiotti_mikado_global_Framework;
		
		$biagiotti_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$biagiotti_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$biagiotti_portfolio_images = new BiagiottiMikadoClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'biagiotti-core' ), '', '', 'portfolio_images' );
		$biagiotti_mikado_global_Framework->mkdMetaBoxes->addMetaBox( 'portfolio_images', $biagiotti_portfolio_images );
		
		$biagiotti_portfolio_image_gallery = new BiagiottiMikadoClassMultipleImages( 'mkdf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'biagiotti-core' ), esc_html__( 'Choose your portfolio images', 'biagiotti-core' ) );
		$biagiotti_portfolio_images->addChild( 'mkdf-portfolio-image-gallery', $biagiotti_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$biagiotti_portfolio_images_videos = biagiotti_mikado_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'biagiotti-core' ),
				'name'  => 'mkdf_portfolio_images_videos'
			)
		);
		biagiotti_mikado_add_repeater_field(
			array(
				'name'        => 'mkdf_portfolio_single_upload',
				'parent'      => $biagiotti_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'biagiotti-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'biagiotti-core' ),
						'options' => array(
							'image' => esc_html__('Image','biagiotti-core'),
							'video' => esc_html__('Video','biagiotti-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'biagiotti-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'biagiotti-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'biagiotti-core'),
							'vimeo' => esc_html__('Vimeo', 'biagiotti-core'),
							'self' => esc_html__('Self Hosted', 'biagiotti-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'biagiotti-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'biagiotti-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'biagiotti-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$biagiotti_additional_sidebar_items = biagiotti_mikado_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'biagiotti-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		biagiotti_mikado_add_repeater_field(
			array(
				'name'        => 'mkdf_portfolio_properties',
				'parent'      => $biagiotti_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'biagiotti-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'biagiotti-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'biagiotti-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'biagiotti-core' )
					)
				)
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_core_map_portfolio_meta', 40 );
}