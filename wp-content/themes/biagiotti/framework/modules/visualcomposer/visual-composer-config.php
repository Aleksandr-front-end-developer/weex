<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = BIAGIOTTI_MIKADO_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'biagiotti_mikado_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function biagiotti_mikado_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'biagiotti_mikado_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'biagiotti_mikado_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function biagiotti_mikado_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'biagiotti' ),
				'value'      => array(
					esc_html__( 'Full Width', 'biagiotti' ) => 'full-width',
					esc_html__( 'In Grid', 'biagiotti' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Mikado Anchor ID', 'biagiotti' ),
				'description' => esc_html__( 'For example "home"', 'biagiotti' ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'simple_background_image_repeat',
				'heading'    => esc_html__( 'Mikado Background Image Repeat', 'biagiotti' ),
				'value'      => array(
					esc_html__( 'Horizontal And Vertical Repeat', 'biagiotti' ) => 'repeat',
					esc_html__( 'Horizontal Repeat Only', 'biagiotti' )         => 'repeat-x',
					esc_html__( 'Vertical Repeat Only', 'biagiotti' )           => 'repeat-y',
					esc_html__( 'No', 'biagiotti' )                             => 'no-repeat'
				),
				'dependency' => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Mikado Background Position', 'biagiotti' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'biagiotti' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'biagiotti' ),
				'value'       => array(
					esc_html__( 'Never', 'biagiotti' )        => '',
					esc_html__( 'Below 1280px', 'biagiotti' ) => '1280',
					esc_html__( 'Below 1024px', 'biagiotti' ) => '1024',
					esc_html__( 'Below 768px', 'biagiotti' )  => '768',
					esc_html__( 'Below 680px', 'biagiotti' )  => '680',
					esc_html__( 'Below 480px', 'biagiotti' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'biagiotti' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Mikado Parallax Background Image', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Mikado Parallax Speed', 'biagiotti' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'biagiotti' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Mikado Parallax Section Height (px)', 'biagiotti' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		
		
		
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textarea_raw_html',
				'param_name'  => 'bg_svg_source',
				'heading'     => esc_html__( 'Background SVG Source', 'biagiotti' ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_svg_rotate',
				'heading'     => esc_html__( 'Background SVG Rotation (deg)', 'biagiotti' ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_svg_top',
				'heading'     => esc_html__( 'Background SVG Top Offset (px or %)', 'biagiotti' ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_svg_left',
				'heading'     => esc_html__( 'Background SVG Left Offset (px or %)', 'biagiotti' ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_text',
				'heading'     => esc_html__( 'Background Text', 'biagiotti' ),
				'admin_label' => true,
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'bg_text_appear',
				'heading'     => esc_html__( 'Background Text Appear', 'biagiotti' ),
				'value'       => array(
					esc_html__( 'From Right', 'biagiotti' )  => 'mkdf-from-right',
					esc_html__( 'From Left', 'biagiotti' ) => 'mkdf-from-left'
				),
				'dependency'  => array( 'element' => 'bg_text', 'not_empty' => true ),
				'save_always' => true,
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'bg_text_placement',
				'heading'     => esc_html__( 'Background Text Placement', 'biagiotti' ),
				'value'       => array(
					esc_html__( 'Default', 'biagiotti' )         => '',
					esc_html__( 'Within Row Only', 'biagiotti' ) => 'mkdf-inside-placement'
				),
				'dependency'  => array( 'element' => 'bg_text', 'not_empty' => true ),
				'save_always' => true,
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'bg_text_bottom',
				'heading'    => esc_html__( 'Background Text Bottom Offset (px or %)', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'bg_text_right',
				'heading'    => esc_html__( 'Background Text Right Offset (px or %)', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'bg_text_font_size',
				'heading'    => esc_html__( 'Background Text Font size (px)', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'bg_text_color',
				'heading'    => esc_html__( 'Background Text Color', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_text_transparency',
				'heading'     => esc_html__( 'Background Text Transparency', 'biagiotti' ),
				'description' => esc_html__( 'Choose a transparency for the background text (0 = fully transparent, 1 = opaque)', 'biagiotti' ),
				'admin_label' => true,
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		
		
		
		
		
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'biagiotti' ),
				'value'      => array(
					esc_html__( 'Default', 'biagiotti' ) => '',
					esc_html__( 'Left', 'biagiotti' )    => 'left',
					esc_html__( 'Center', 'biagiotti' )  => 'center',
					esc_html__( 'Right', 'biagiotti' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);

		do_action( 'biagiotti_mikado_action_additional_vc_row_params' );
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'biagiotti' ),
				'value'      => array(
					esc_html__( 'Full Width', 'biagiotti' ) => 'full-width',
					esc_html__( 'In Grid', 'biagiotti' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'simple_background_image_repeat',
				'heading'    => esc_html__( 'Mikado Background Image Repeat', 'biagiotti' ),
				'value'      => array(
					esc_html__( 'Horizontal And Vertical Repeat', 'biagiotti' ) => 'repeat',
					esc_html__( 'Horizontal Repeat Only', 'biagiotti' )         => 'repeat-x',
					esc_html__( 'Vertical Repeat Only', 'biagiotti' )           => 'repeat-y',
					esc_html__( 'No', 'biagiotti' )                             => 'no-repeat'
				),
				'dependency' => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Mikado Background Position', 'biagiotti' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'biagiotti' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'biagiotti' ),
				'value'       => array(
					esc_html__( 'Never', 'biagiotti' )        => '',
					esc_html__( 'Below 1280px', 'biagiotti' ) => '1280',
					esc_html__( 'Below 1024px', 'biagiotti' ) => '1024',
					esc_html__( 'Below 768px', 'biagiotti' )  => '768',
					esc_html__( 'Below 680px', 'biagiotti' )  => '680',
					esc_html__( 'Below 480px', 'biagiotti' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'biagiotti' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textarea_raw_html',
				'param_name'  => 'bg_svg_source',
				'heading'     => esc_html__( 'Background SVG Source', 'biagiotti' ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_svg_rotate',
				'heading'     => esc_html__( 'Background SVG Rotation (deg)', 'biagiotti' ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_svg_top',
				'heading'     => esc_html__( 'Background SVG Top Offset (px or %)', 'biagiotti' ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_svg_left',
				'heading'     => esc_html__( 'Background SVG Left Offset (px or %)', 'biagiotti' ),
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_text',
				'heading'     => esc_html__( 'Background Text', 'biagiotti' ),
				'admin_label' => true,
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'bg_text_appear',
				'heading'     => esc_html__( 'Background Text Appear', 'biagiotti' ),
				'value'       => array(
					esc_html__( 'From Right', 'biagiotti' )  => 'mkdf-from-right',
					esc_html__( 'From Left', 'biagiotti' ) => 'mkdf-from-left'
				),
				'dependency'  => array( 'element' => 'bg_text', 'not_empty' => true ),
				'save_always' => true,
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'bg_text_placement',
				'heading'     => esc_html__( 'Background Text Placement', 'biagiotti' ),
				'value'       => array(
					esc_html__( 'Default', 'biagiotti' )         => '',
					esc_html__( 'Within Row Only', 'biagiotti' ) => 'mkdf-inside-placement'
				),
				'dependency'  => array( 'element' => 'bg_text', 'not_empty' => true ),
				'save_always' => true,
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'bg_text_bottom',
				'heading'    => esc_html__( 'Background Text Bottom Offset (px or %)', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'bg_text_right',
				'heading'    => esc_html__( 'Background Text Right Offset (px or %)', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'bg_text_font_size',
				'heading'    => esc_html__( 'Background Text Font size (px)', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'bg_text_color',
				'heading'    => esc_html__( 'Background Text Color', 'biagiotti' ),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'bg_text_transparency',
				'heading'     => esc_html__( 'Background Text Transparency', 'biagiotti' ),
				'description' => esc_html__( 'Choose a transparency for the background text (0 = fully transparent, 1 = opaque)', 'biagiotti' ),
				'admin_label' => true,
				'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'biagiotti' ),
				'value'      => array(
					esc_html__( 'Default', 'biagiotti' ) => '',
					esc_html__( 'Left', 'biagiotti' )    => 'left',
					esc_html__( 'Center', 'biagiotti' )  => 'center',
					esc_html__( 'Right', 'biagiotti' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'biagiotti' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( biagiotti_mikado_is_plugin_installed( 'revolution-slider' ) ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Mikado Enable Passepartout', 'biagiotti' ),
					'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Mikado Passepartout Size', 'biagiotti' ),
					'value'       => array(
						esc_html__( 'Tiny', 'biagiotti' )   => 'tiny',
						esc_html__( 'Small', 'biagiotti' )  => 'small',
						esc_html__( 'Normal', 'biagiotti' ) => 'normal',
						esc_html__( 'Large', 'biagiotti' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Side Passepartout', 'biagiotti' ),
					'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Top Passepartout', 'biagiotti' ),
					'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'biagiotti' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'biagiotti_mikado_vc_row_map' );
}