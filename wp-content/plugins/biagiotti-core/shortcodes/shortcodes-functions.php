<?php

if ( ! function_exists( 'biagiotti_core_include_shortcodes_file' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function biagiotti_core_include_shortcodes_file() {
		if ( biagiotti_core_theme_installed() && biagiotti_core_is_theme_registered() ) {
			foreach ( glob( BIAGIOTTI_CORE_SHORTCODES_PATH . '/*/load.php' ) as $shortcode ) {
				if ( biagiotti_mikado_is_customizer_item_enabled( $shortcode, 'biagiotti_performance_disable_shortcode_' ) ) {
					include_once $shortcode;
				}
			}
		}
		
		do_action( 'biagiotti_core_action_include_shortcodes_file' );
	}
	
	add_action( 'init', 'biagiotti_core_include_shortcodes_file', 6 ); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if ( ! function_exists( 'biagiotti_core_load_shortcodes' ) ) {
	function biagiotti_core_load_shortcodes() {
		include_once BIAGIOTTI_CORE_ABS_PATH . '/lib/shortcode-loader.php';
		
		BiagiottiCore\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action( 'init', 'biagiotti_core_load_shortcodes', 7 ); // permission 7 is set to be before vc_before_init hook that has permission 9 and after biagiotti_core_include_shortcodes_file hook
}

if ( ! function_exists( 'biagiotti_core_add_admin_shortcodes_styles' ) ) {
	/**
	 * Function that includes shortcodes core styles for admin
	 */
	function biagiotti_core_add_admin_shortcodes_styles() {
		
		//include shortcode styles for Visual Composer
		wp_enqueue_style( 'biagiotti-core-vc-shortcodes', BIAGIOTTI_CORE_ASSETS_URL_PATH . '/css/admin/biagiotti-vc-shortcodes.css' );
	}
	
	add_action( 'biagiotti_mikado_action_admin_scripts_init', 'biagiotti_core_add_admin_shortcodes_styles' );
}

if ( ! function_exists( 'biagiotti_core_add_admin_shortcodes_custom_styles' ) ) {
	/**
	 * Function that print custom vc shortcodes style
	 */
	function biagiotti_core_add_admin_shortcodes_custom_styles() {
		$style                  = apply_filters( 'biagiotti_core_filter_add_vc_shortcodes_custom_style', $style = '' );
		$shortcodes_icon_styles = array();
		$shortcode_icon_size    = 32;
		$shortcode_position     = 0;
		
		$shortcodes_icon_class_array = apply_filters( 'biagiotti_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );
		
		if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
				$mark = $shortcode_position != 0 ? '-' : '';
				
				$shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-icon' . esc_attr( $shortcode_icon_class ) . ' {
					background-position: ' . $mark . esc_attr( $shortcode_position * $shortcode_icon_size ) . 'px 0;
				}';
				
				$shortcode_position ++;
			}
		}
		
		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style .= implode( ' ', $shortcodes_icon_styles );
		}
		
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'biagiotti-core-vc-shortcodes', $style );
		}
	}
	
	add_action( 'biagiotti_mikado_action_admin_scripts_init', 'biagiotti_core_add_admin_shortcodes_custom_styles' );
}


if ( ! function_exists( 'biagiotti_core_load_elementor_shortcodes' ) ) {
	/**
	 * Function that loads elementor files inside shortcodes folder
	 */
	function biagiotti_core_load_elementor_shortcodes() {
		if ( biagiotti_core_theme_installed() && biagiotti_mikado_is_elementor_installed() && biagiotti_core_is_theme_registered() ) {
			foreach ( glob( BIAGIOTTI_CORE_SHORTCODES_PATH . '/*/elementor-*.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'biagiotti_core_load_elementor_shortcodes' );
}

if ( ! function_exists( 'biagiotti_core_add_elementor_widget_categories' ) ) {
	/**
	 * Registers category group
	 */
	function biagiotti_core_add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'mikado',
			[
				'title' => esc_html__( 'Mikado', 'biagiotti-core' ),
				'icon'  => 'fa fa-plug',
			]
		);

	}

	add_action( 'elementor/elements/categories_registered', 'biagiotti_core_add_elementor_widget_categories' );
}

if( ! function_exists( 'biagiotti_core_remove_widgets_for_elementor') ) {
	function biagiotti_core_remove_widgets_for_elementor( $black_list ) {

		$black_list[] = 'BiagiottiMikadoClassSearchOpener';
		$black_list[] = 'BiagiottiMikadoClassSideAreaOpener';
		$black_list[] = 'BiagiottiMikadoClassAuthorInfoWidget';
		$black_list[] = 'BiagiottiMikadoClassBlogListWidget';
		$black_list[] = 'BiagiottiMikadoClassButtonWidget';
		$black_list[] = 'BiagiottiMikadoClassContactForm7Widget';
		$black_list[] = 'BiagiottiMikadoClassCustomFontWidget';
		$black_list[] = 'BiagiottiMikadoClassIconWidget';
		$black_list[] = 'BiagiottiMikadoClassImageGalleryWidget';
		$black_list[] = 'BiagiottiMikadoClassRecentPosts';
		$black_list[] = 'BiagiottiMikadoClassSearchPostType';
		$black_list[] = 'BiagiottiMikadoClassSeparatorWidget';
		$black_list[] = 'BiagiottiMikadoClassSocialIconWidget';
		$black_list[] = 'BiagiottiMikadoClassClassIconsGroupWidget';
		$black_list[] = 'BiagiottiMikadoClassStickySidebar';
		$black_list[] = 'BiagiottiMikadoClassWoocommerceDropdownCart';
		$black_list[] = 'biagiottimikadoClassWoocommerceDropdownCart';

		return $black_list;
	}

	add_filter('elementor/widgets/black_list', 'biagiotti_core_remove_widgets_for_elementor');
}

if ( ! function_exists( 'biagiotti_core_return_elementor_templates' ) ) {
	/**
	 * Function that returns all Elementor saved templates
	 */
	function biagiotti_core_return_elementor_templates() {
		return Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
	}
}

if ( ! function_exists( 'biagiotti_core_generate_elementor_templates_control' ) ) {
	/**
	 * Function that adds Template Elementor Control
	 */
	function biagiotti_core_generate_elementor_templates_control( $object ) {
		$templates = biagiotti_core_return_elementor_templates();

		//if ( ! empty( $templates ) ) {
			$options = [
				'0' => '— ' . esc_html__( 'Select', 'biagiotti-core' ) . ' —',
			];

			$types = [];

			if ( ! empty( $templates ) ) {

				foreach ( $templates as $template ) {
					$options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
					$types[ $template['template_id'] ]   = $template['type'];
				}
			};

			$object->add_control(
				'template_id',
				[
					'label'       => esc_html__( 'Choose Template', 'biagiotti-core' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => '0',
					'options'     => $options,
					'types'       => $types,
					'label_block' => 'true'
				]
			);

	}
}

//function that maps "Anchor" option for section
if( ! function_exists('biagiotti_core_map_section_anchor_option') ){
	function biagiotti_core_map_section_anchor_option( $section, $args ){
		$section->start_controls_section(
			'section_mikado_anchor',
			[
				'label' => esc_html__( 'Biagiotti Anchor', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'anchor_id',
			[
				'label' => esc_html__( 'Biagiotti Anchor ID', 'biagiotti-core' ),
				'type'  => Elementor\Controls_Manager::TEXT,
			]
		);

		$section->end_controls_section();
	}

	add_action('elementor/element/section/_section_responsive/after_section_end', 'biagiotti_core_map_section_anchor_option', 10, 2);
}

//function that renders "Anchor" option for section
if( ! function_exists('biagiotti_core_render_section_anchor_option') ) {
	function biagiotti_core_render_section_anchor_option( $element )   {
		if( 'section' !== $element->get_name() ) {
			return;
		}

		$params = $element->get_settings_for_display();

		if( ! empty( $params['anchor_id'] ) ){
			$element->add_render_attribute( '_wrapper', 'data-mkdf-anchor', $params['anchor_id'] );
		}
	}

	add_action( 'elementor/frontend/section/before_render', 'biagiotti_core_render_section_anchor_option');
}

//function that maps "Parallax" option for section
if ( ! function_exists( 'biagiotti_core_map_section_parallax_option' ) ) {
	function biagiotti_core_map_section_parallax_option( $section, $args ) {
		$section->start_controls_section(
			'section_mikado_parallax',
			[
				'label' => esc_html__( 'Biagiotti Parallax', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'mikado_enable_parallax',
			[
				'label'        => esc_html__( 'Enable Parallax', 'biagiotti-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'     => esc_html__( 'No', 'biagiotti-core' ),
					'holder' => esc_html__( 'Yes', 'biagiotti-core' ),
				],
				'prefix_class' => 'mkdf-parallax-row-'
			]
		);

		$section->add_control(
			'mikado_parallax_image',
			[
				'label'              => esc_html__( 'Parallax Image', 'biagiotti-core' ),
				'type'               => Elementor\Controls_Manager::MEDIA,
				'condition'          => [
					'mikado_enable_parallax' => 'holder'
				],
				'frontend_available' => true,
			]
		);

		$section->add_control(
			'mikado_parallax_speed',
			[
				'label'     => esc_html__( 'Parallax Speed', 'biagiotti-core' ),
				'type'      => Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mikado_enable_parallax' => 'holder'
				],
				'default'   => ''
			]
		);

		$section->add_control(
			'mikado_parallax_height',
			[
				'label'     => esc_html__( 'Parallax Section Height (px)', 'biagiotti-core' ),
				'type'      => Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mikado_enable_parallax' => 'holder'
				],
				'default'   => ''
			]
		);

		$section->end_controls_section();
	}

	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'biagiotti_core_map_section_parallax_option', 10, 2 );
}

//frontend function for "Parallax"
if ( ! function_exists( 'biagiotti_core_render_section_parallax_option' ) ) {
	function biagiotti_core_render_section_parallax_option( $element ) {
		if ( 'section' !== $element->get_name() ) {
			return;
		}

		$params = $element->get_settings_for_display();

		if ( ! empty( $params['mikado_parallax_image']['id'] ) ) {
			$parallax_image_src = $params['mikado_parallax_image']['url'];
			$parallax_speed     = ! empty( $params['mikado_parallax_speed'] ) ? $params['mikado_parallax_speed'] : '1';
			$parallax_height    = ! empty( $params['mikado_parallax_height'] ) ? $params['mikado_parallax_height'] : 0;

			$element->add_render_attribute( '_wrapper', 'class', 'mkdf-parallax-row-holder' );
			$element->add_render_attribute( '_wrapper', 'data-parallax-bg-speed', $parallax_speed );
			$element->add_render_attribute( '_wrapper', 'data-parallax-bg-image', $parallax_image_src );
			$element->add_render_attribute( '_wrapper', 'data-parallax-bg-height', $parallax_height );
		}
	}

	add_action( 'elementor/frontend/section/before_render', 'biagiotti_core_render_section_parallax_option' );
}

//function that renders helper hidden input for parallax data attribute section
if ( ! function_exists( 'biagiotti_core_generate_parallax_helper' ) ) {
	function biagiotti_core_generate_parallax_helper( $template, $widget ) {
		if ( 'section' === $widget->get_name() ) {
			$template_preceding = "
            <# if( settings.mikado_enable_parallax == 'holder' ){
		        let parallaxSpeed = settings.mikado_parallax_speed !== '' ? settings.mikado_parallax_speed : '1';
	            let parallaxImage = settings.mikado_parallax_image.url !== '' ? settings.mikado_parallax_image.url : '0'
	        #>
		        <input type='hidden' class='mkdf-parallax-helper-holder' data-parallax-bg-speed='{{ parallaxSpeed }}' data-parallax-bg-image='{{ parallaxImage }}'/>
		    <# } #>";
			$template           = $template_preceding . " " . $template;
		}

		return $template;
	}

	add_action( 'elementor/section/print_template', 'biagiotti_core_generate_parallax_helper', 10, 2 );
}

//function that maps "Content Alignment" option for section
if ( ! function_exists( 'biagiotti_core_map_section_content_alignment_option' ) ) {
	function biagiotti_core_map_section_content_alignment_option( $section, $args ) {
		$section->start_controls_section(
			'mikado_section_content_alignment',
			[
				'label' => esc_html__( 'Biagiotti Content Alignment', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'mikado_content_alignment',
			[
				'label'        => esc_html__( 'Content Alignment', 'biagiotti-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'left',
				'options'      => [
					'left'   => esc_html__( 'Left', 'biagiotti-core' ),
					'center' => esc_html__( 'Center', 'biagiotti-core' ),
					'right'  => esc_html__( 'Right', 'biagiotti-core' )
				],
				'prefix_class' => 'mkdf-content-aligment-'
			]
		);

		$section->end_controls_section();
	}

	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'biagiotti_core_map_section_content_alignment_option', 10, 2 );
}

//function that maps "Grid" option for section
if ( ! function_exists( 'biagiotti_core_map_section_grid_option' ) ) {
	function biagiotti_core_map_section_grid_option( $section, $args ) {
		$section->start_controls_section(
			'mikado_section_grid_row',
			[
				'label' => esc_html__( 'Biagiotti Grid', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'mikado_enable_grid_row',
			[
				'label'        => esc_html__( 'Make this row "In Grid"', 'biagiotti-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'      => esc_html__( 'No', 'biagiotti-core' ),
					'section' => esc_html__( 'Yes', 'biagiotti-core' ),
				],
				'prefix_class' => 'mkdf-row-grid-'
			]
		);

		$section->end_controls_section();
	}

	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'biagiotti_core_map_section_grid_option', 10, 2 );
}

//function that adds maps "Disable Background" option for section
if ( ! function_exists( 'biagiotti_core_map_section_disable_background' ) ) {
	function biagiotti_core_map_section_disable_background( $section, $args ) {
		$section->start_controls_section(
			'mikado_section_background',
			[
				'label' => esc_html__( 'Biagiotti Background', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'mikado_disable_background',
			[
				'label'        => esc_html__( 'Disable row background', 'biagiotti-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'   => esc_html__( 'Never', 'biagiotti-core' ),
					'1280' => esc_html__( 'Below 1280px', 'biagiotti-core' ),
					'1024' => esc_html__( 'Below 1024px', 'biagiotti-core' ),
					'768'  => esc_html__( 'Below 768px', 'biagiotti-core' ),
					'680'  => esc_html__( 'Below 680px', 'biagiotti-core' ),
					'480'  => esc_html__( 'Below 480px', 'biagiotti-core' )
				],
				'prefix_class' => 'mkdf-disabled-bg-image-bellow-'
			]
		);

		$section->add_control(
			'bg_svg_source',
			[
				'label' => esc_html__( 'Background SVG Source', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$section->add_control(
			'bg_svg_rotate',
			[
				'label' => esc_html__( 'Background SVG Rotation (deg)', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$section->add_control(
			'bg_svg_top',
			[
				'label' => esc_html__( 'Background SVG Top Offset (px or %)', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$section->add_control(
			'bg_svg_left',
			[
				'label' => esc_html__( 'Background SVG Left Offset (px or %)', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$section->add_control(
			'bg_text',
			[
				'label' => esc_html__( 'Background Text', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$section->add_control(
			'bg_text_appear',
			[
				'label'     => esc_html__( 'Background Text Appear', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'mkdf-from-right'       => esc_html__( 'From Right', 'biagiotti-core' ),
					'mkdf-from-left'   => esc_html__( 'From Left', 'biagiotti-core' )
				],
				'default'   => 'mkdf-from-right',
				'condition' => [
					'bg_text!' => ''
				],
			]
		);

		$section->add_control(
			'bg_text_placement',
			[
				'label'     => esc_html__( 'Background Text Placement', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''       => esc_html__( 'Default', 'biagiotti-core' ),
					'mkdf-inside-placement'   => esc_html__( 'Within Row Only', 'biagiotti-core' )
				],
				'default'   => '',
				'condition' => [
					'bg_text!' => ''
				],
			]
		);

		$section->add_control(
			'bg_text_bottom',
			[
				'label' => esc_html__( 'Background Text Bottom Offset (px or %)', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$section->add_control(
			'bg_text_right',
			[
				'label' => esc_html__( 'Background Text Right Offset (px or %)', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$section->add_control(
			'bg_text_font_size',
			[
				'label' => esc_html__( 'Background Text Font size (px)', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$section->add_control(
			'bg_text_color',
			[
				'label' => esc_html__( 'Background Text Color', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		$section->add_control(
			'bg_text_transparency',
			[
				'label' => esc_html__( 'Background Text Transparency', 'biagiotti' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Choose a transparency for the background text (0 = fully transparent, 1 = opaque)', 'biagiotti' )
			]
		);

		$section->end_controls_section();
	}

	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'biagiotti_core_map_section_disable_background', 10, 2 );
}

//function that renders background elements in frontend
if ( ! function_exists( 'biagiotti_core_render_section_background_option' ) ) {
	function biagiotti_core_render_section_background_option( $element ) {
		if ( 'section' !== $element->get_name() ) {
			return;
		}

		$params = $element->get_settings_for_display();

		$mkdf_bg_svg_html = '';
		if ( !empty($params['bg_svg_source']) ) {

			if ( biagiotti_mikado_is_plugin_installed('core') ) {
				$bg_svg_source = $params['bg_svg_source'];
			} else {
				$bg_svg_source = '';
			}

			$bg_svg_styles = array();

			if ( ! empty( $params['bg_svg_rotate'] ) ) {
				$bg_svg_rotate = biagiotti_mikado_filter_suffix( $params['bg_svg_rotate'], 'deg' ) . 'deg';
				$bg_svg_styles[] = 'transform: rotate(' . esc_attr( $bg_svg_rotate ) . ')';
			}

			if ( ! empty( $params['bg_svg_top'] ) ) {
				if ( ! biagiotti_mikado_string_ends_with( $params['bg_svg_top'], '%' ) && ! biagiotti_mikado_string_ends_with( $params['bg_svg_top'], 'px' ) ) {
					$bg_svg_top = biagiotti_mikado_filter_px( $params['bg_svg_top'] ) . 'px';
				}
				$bg_svg_styles[] = 'top: ' . esc_attr( $bg_svg_top );
			}

			if ( ! empty( $params['bg_svg_left'] ) ) {
				if ( ! biagiotti_mikado_string_ends_with( $params['bg_svg_left'], '%' ) && ! biagiotti_mikado_string_ends_with( $params['bg_svg_left'], 'px' ) ) {
					$bg_svg_left = biagiotti_mikado_filter_px( $params['bg_svg_left'] ) . 'px';
				}
				$bg_svg_styles[] = 'left: ' . esc_attr( $bg_svg_left );
			}

			//generate background text html
			$mkdf_bg_svg_html = '<div class="mkdf-row-bg-svg-holder">';
			$mkdf_bg_svg_html .= '<span class="mkdf-row-bg-svg" ' . biagiotti_mikado_get_inline_style( $bg_svg_styles ) . '>'.biagiotti_mikado_get_module_part($bg_svg_source).'</span>';
			$mkdf_bg_svg_html .= '</div>';
		}

		$mkdf_bg_text_html = '';
		if ( !empty($params['bg_text']) ) {
			$bg_text_holder_styles = array();
			$bg_text_styles        = array();

			if ( ! empty( $params['bg_text_bottom'] ) ) {
				if ( ! biagiotti_mikado_string_ends_with( $params['bg_text_bottom'], '%' ) && ! biagiotti_mikado_string_ends_with( $params['bg_text_bottom'], 'px' ) ) {
					$params['bg_text_bottom'] = biagiotti_mikado_filter_px( $params['bg_text_bottom'] ) . 'px';
				}
				$bg_text_holder_styles[] = 'bottom: ' . esc_attr( $params['bg_text_bottom'] );
			}

			if ( ! empty( $params['bg_text_right'] ) ) {
				if ( ! biagiotti_mikado_string_ends_with( $params['bg_text_right'], '%' ) && ! biagiotti_mikado_string_ends_with( $params['bg_text_right'], 'px' ) ) {
					$params['bg_text_right'] = biagiotti_mikado_filter_px( $params['bg_text_right'] ) . 'px';
				}
				$bg_text_holder_styles[] = 'right: ' . esc_attr( $params['bg_text_right'] );
			}

			if ( ! empty( $params['bg_text_font_size'] ) ) {
				$bg_text_font_size = biagiotti_mikado_filter_suffix( $params['bg_text_font_size'], 'px' ) . 'px';
				$bg_text_styles[]  = 'font-size: ' . esc_attr( $bg_text_font_size );
			}

			if ( ! empty( $params['bg_text_color'] ) ) {
				$bg_text_styles[] = 'color: ' . esc_attr( $params['bg_text_color'] );
			}

			if ( ! empty( $params['bg_text_transparency'] ) ) {
				$bg_text_styles[] = 'opacity: ' . esc_attr( $params['bg_text_transparency'] );
			}

			//generate background text html
			$mkdf_bg_text_html = '<div class="mkdf-row-bg-text-holder '.esc_attr( $params['bg_text_appear'] ).' '.esc_attr( $params['bg_text_placement'] ).'" ' . biagiotti_mikado_get_inline_style( $bg_text_holder_styles ) . '>';
			$mkdf_bg_text_html .= '<div class="mkdf-row-bg-text-inner">';
			$mkdf_bg_text_html .= '<span class="mkdf-row-bg-text" ' . biagiotti_mikado_get_inline_style( $bg_text_styles ) . '>'.esc_attr($params['bg_text']).'</span>';
			$mkdf_bg_text_html .= '</div>';
			$mkdf_bg_text_html .= '</div>';
		}

		echo biagiotti_mikado_get_module_part($mkdf_bg_svg_html);
		echo biagiotti_mikado_get_module_part($mkdf_bg_text_html);
	}

	add_action( 'elementor/frontend/section/before_render', 'biagiotti_core_render_section_background_option' );
}

//function that renders background elements in admin
if ( ! function_exists( 'biagiotti_core_render_section_background_option_admin' ) ) {
	function biagiotti_core_render_section_background_option_admin( $template, $widget ) {
		if ( 'section' === $widget->get_name() ) {

			$template_svg = "
            <# 
            
            if( settings.bg_svg_source !== '' ){
            	let bg_svg_source = settings.bg_svg_source;
            	
            	let bg_svg_rotate = '';
            	if( settings.bg_svg_rotate !== '' ){
            		bg_svg_rotate =  'transform: rotate(' + settings.bg_svg_rotate + 'deg);';
            	}
            	
            	let bg_svg_top = '';
            	if( settings.bg_svg_top !== '' ){
            		bg_svg_top =  'top:' + settings.bg_svg_top + 'px;';
            	}
            	
            	let bg_svg_left = '';
            	if( settings.bg_svg_left !== '' ){
            		bg_svg_left =  'left:' + settings.bg_svg_left + 'px;';
            	}
	        #>
	        	<div class='mkdf-row-bg-svg-holder'><span class='mkdf-row-bg-svg' style='{{ bg_svg_rotate }} {{ bg_svg_top }} {{ bg_svg_left }}' >{{{bg_svg_source}}}</span></div>
		    <# } #>";

			$template_text = "
            <# 
            
            if( settings.bg_text !== '' ){
            	let bg_text = settings.bg_text;
            	let bg_text_appear = settings.bg_text_appear;
            	let bg_text_placement = settings.bg_text_placement;
            	
            	let bg_text_bottom = '';
            	if( settings.bg_text_bottom !== '' ){
            		bg_text_bottom =  'bottom:' + settings.bg_text_bottom + ';';
            	}
            	
            	let bg_text_right = '';
            	if( settings.bg_text_right !== '' ){
            		bg_text_right =  'right:' + settings.bg_text_right + ';';
            	}
            	
            	let bg_text_font_size = '';
            	if( settings.bg_text_font_size !== '' ){
            		bg_text_font_size =  'font-size:' + settings.bg_text_font_size + 'px;';
            	}
            	
            	let bg_text_color = '';
            	if( settings.bg_text_color !== '' ){
            		bg_text_color =  'color:' + settings.bg_text_color + ';';
            	}
            	
            	let bg_text_transparency = '';
            	if( settings.bg_text_transparency !== '' ){
            		bg_text_transparency =  'opacity:' + settings.bg_text_transparency + ';';
            	}
	        #>
	        	<div class='mkdf-row-bg-text-holder {{bg_text_appear}} {{bg_text_placement}}' style='{{ bg_text_bottom }} {{ bg_text_right }}'><div class='mkdf-row-bg-text-inner'><span class='mkdf-row-bg-text' style='{{ bg_text_color }} {{ bg_text_transparency }} {{ bg_text_font_size }}'>{{bg_text}}</span> </div></div>
 			<# } #>";

			$template = $template_svg . $template_text . " " . $template;
		}

		return $template;
	}

	add_action( 'elementor/section/print_template', 'biagiotti_core_render_section_background_option_admin', 10, 2 );
}

if( ! function_exists('biagiotti_core_elementor_icons_style') ){
	function biagiotti_core_elementor_icons_style(){

		wp_enqueue_style( 'biagiotti-core-elementor', BIAGIOTTI_CORE_ASSETS_URL_PATH . '/css/admin/biagiotti-elementor.css');

	}

	add_action( 'elementor/editor/before_enqueue_scripts', 'biagiotti_core_elementor_icons_style' );
}


if ( ! function_exists( 'biagiotti_core_get_elementor_shortcodes_path' ) ) {
	function biagiotti_core_get_elementor_shortcodes_path() {
		$shortcodes       = array();
		$shortcodes_paths = array(
			BIAGIOTTI_CORE_SHORTCODES_PATH . '/*' => BIAGIOTTI_CORE_URL_PATH,
			BIAGIOTTI_CORE_CPT_PATH . '/**/shortcodes/*' => BIAGIOTTI_CORE_URL_PATH,
			BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/**/shortcodes/*' => BIAGIOTTI_MIKADO_FRAMEWORK_ROOT . '/'
		);

		if( biagiotti_core_is_instagram_plugin_installed() ) {
			$shortcodes_paths[BIAGIOTTI_INSTAGRAM_SHORTCODES_PATH . '/*'] = BIAGIOTTI_INSTAGRAM_URL_PATH;
		}

		if( biagiotti_core_is_twitter_plugin_installed() ) {
			$shortcodes_paths[BIAGIOTTI_TWITTER_SHORTCODES_PATH . '/*'] = BIAGIOTTI_TWITTER_URL_PATH;
		}

		if( biagiotti_core_is_membership_plugin_installed() ) {
			$shortcodes_paths[BIAGIOTTI_MEMBERSHIP_SHORTCODES_PATH . '/*'] = BIAGIOTTI_MEMBERSHIP_URL_PATH;
		}

		foreach ( $shortcodes_paths as $dir_path => $url_path ) {
			foreach ( glob( $dir_path, GLOB_ONLYDIR ) as $shortcode_dir_path ) {
				$shortcode_name     = basename( $shortcode_dir_path );
				$shortcode_url_path = $url_path . substr( $shortcode_dir_path, strpos( $shortcode_dir_path, basename( $url_path ) ) + strlen( basename( $url_path ) ) + 1 );

				$shortcodes[ $shortcode_name ] = array(
					'dir_path' => $shortcode_dir_path,
					'url_path' => $shortcode_url_path
				);
			}
		}

		return $shortcodes;
	}
}
if ( ! function_exists( 'biagiotti_core_add_elementor_shortcodes_custom_styles' ) ) {
	function biagiotti_core_add_elementor_shortcodes_custom_styles() {
		$style                  = '';
		$shortcodes_icon_styles = array();

		$shortcodes_icon_class_array = apply_filters( 'biagiotti_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );

		$shortcodes_path = biagiotti_core_get_elementor_shortcodes_path();
		if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
				$shortcode_name = str_replace( '.icon-wpb-', '', esc_attr( $shortcode_icon_class ) );

				if ( key_exists( $shortcode_name, $shortcodes_path ) && file_exists( $shortcodes_path[ $shortcode_name ]['dir_path'] . '/assets/img/dashboard_icon.png' ) ) {
					$shortcodes_icon_styles[] = '.biagiotti-elementor-custom-icon.biagiotti-elementor-' . $shortcode_name . ' {
                        background-image: url( "' . $shortcodes_path[ $shortcode_name ]['url_path'] . '/assets/img/dashboard_icon.png" );
                    }';
				}
			}
		}

		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style = implode( ' ', $shortcodes_icon_styles );
		}
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'biagiotti-core-elementor', $style );
		}
	}

	add_action( 'elementor/editor/before_enqueue_scripts', 'biagiotti_core_add_elementor_shortcodes_custom_styles', 15 );
}
