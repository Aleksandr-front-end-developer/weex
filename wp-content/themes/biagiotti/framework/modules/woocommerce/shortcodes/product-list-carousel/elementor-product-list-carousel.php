<?php

class BiagiottiMikadoElementorProductListCarousel extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_product_list_carousel';
    }

    public function get_title() {
        return esc_html__( 'Product List - Carousel', 'biagiotti' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-product-list-carousel';
    }

    public function get_categories() {
        return [ 'mikado' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'biagiotti' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'info_position',
			[
				'label'   => esc_html__( 'Product Info Position', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'info-on-image'    => esc_html__( 'Info On Image Hover', 'biagiotti' ),
					'info-below-image' => esc_html__( 'Info Below Image', 'biagiotti' )
				],
				'default' => 'info-on-image'
			]
		);

        $this->add_control(
            'number_of_posts',
            [
                'label'   => esc_html__( 'Number of Products', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '8'
            ]
        );

        $this->add_control(
            'space_between_items',
            [
                'label'     => esc_html__( 'Space Between Items', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_space_between_items_array(),
                'default'   => 'normal'
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_query_order_by_array( false, array( 'on-sale' => esc_html__( 'On Sale', 'biagiotti' ) ) ),
                'default' => 'date'
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_query_order_array(),
                'order'   => 'ASC'
            ]
        );

        $this->add_control(
            'taxonomy_to_display',
            [
                'label'       => esc_html__( 'Choose Sorting Taxonomy', 'biagiotti' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => [
                    'category' => esc_html__( 'Category', 'biagiotti' ),
                    'tag'      => esc_html__( 'Tag', 'biagiotti' ),
                    'id'       => esc_html__( 'Id', 'biagiotti' ),
                ],
                'default'     => 'category',
                'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'biagiotti' )
            ]
        );

        $this->add_control(
            'taxonomy_values',
            [
                'label'       => esc_html__( 'Enter Taxonomy Values', 'biagiotti' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'biagiotti' )
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'   => esc_html__( 'Image Proportions', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''                      => esc_html__( 'Default', 'biagiotti' ),
                    'full'                  => esc_html__( 'Original', 'biagiotti' ),
                    'square'                => esc_html__( 'Square', 'biagiotti' ),
                    'landscape'             => esc_html__( 'Landscape', 'biagiotti' ),
                    'portrait'              => esc_html__( 'Portrait', 'biagiotti' ),
                    'medium'                => esc_html__( 'Medium', 'biagiotti' ),
                    'large'                 => esc_html__( 'Large', 'biagiotti' ),
                    'woocommerce_single'    => esc_html__( 'Shop Single', 'biagiotti' ),
                    'woocommerce_thumbnail' => esc_html__( 'Shop Thumbnail', 'biagiotti' ),
                ],
                'default' => 'full'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_settings',
            [
                'label' => esc_html__( 'Slider Settings', 'biagiotti' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_visible_items',
            [
                'label'   => esc_html__( 'Number Of Visible Items', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'One', 'biagiotti' ),
                    '2' => esc_html__( 'Two', 'biagiotti' ),
                    '3' => esc_html__( 'Three', 'biagiotti' ),
                    '4' => esc_html__( 'Four', 'biagiotti' ),
                    '5' => esc_html__( 'Five', 'biagiotti' ),
                    '6' => esc_html__( 'Six', 'biagiotti' ),
                ],
                'default' => '1'
            ]
        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Enable Slider Loop', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Enable Slider Autoplay', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'       => esc_html__( 'Slide Duration', 'biagiotti' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default value is 5000 (ms)', 'biagiotti' ),
                'default'     => '5000'
            ]
        );

        $this->add_control(
            'slider_speed_animation',
            [
                'label'       => esc_html__( 'Slide Animation Duration', 'biagiotti' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'biagiotti' ),
                'default'     => '600'
            ]
        );

        $this->add_control(
            'slider_navigation',
            [
                'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_navigation_skin',
            [
                'label'     => esc_html__( 'Slider Navigation Skin', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'default' => esc_html__( 'Default', 'biagiotti' ),
                    'light'   => esc_html__( 'Light', 'biagiotti' ),
                ],
                'condition' => [
                    'slider_navigation' => array( 'yes' )
                ],
                'default' => 'default'
            ]
        );

		$this->add_control(
			'slider_navigation_pos',
			[
				'label'     => esc_html__( 'Slider Navigation Position', 'biagiotti' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'' => esc_html__( 'Inside Carousel', 'biagiotti' ),
					'outside-slider'   => esc_html__( 'Outside Carousel', 'biagiotti' ),
				],
				'condition' => [
					'slider_navigation' => array( 'yes' )
				],
				'default' => ''
			]
		);

		$this->add_control(
			'slider_navigation_pos_arrow',
			[
				'label'     => esc_html__( 'Slider Navigation Arrow Position', 'biagiotti' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'' => esc_html__( 'Default Position', 'biagiotti' ),
					'predefined-arrow'   => esc_html__( 'Predefined Arrow Position', 'biagiotti' ),
				],
				'condition' => [
					'slider_navigation' => array( 'yes' )
				],
				'default' => ''
			]
		);

        $this->add_control(
            'slider_pagination',
            [
                'label'     => esc_html__( 'Enable Slider Pagination', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'condition' => [
                    'slider_navigation' => array( 'yes' )
                ],
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_pagination_skin',
            [
                'label'     => esc_html__( 'Slider Pagination Skin', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'default' => esc_html__( 'Default', 'biagiotti' ),
                    'light'   => esc_html__( 'Light', 'biagiotti' ),
                ],
                'condition' => [
                    'slider_pagination' => array( 'yes' )
                ],
                'default' => 'default'
            ]
        );

        $this->add_control(
            'slider_pagination_pos',
            [
                'label'     => esc_html__( 'Slider Pagination Position', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    ''  => esc_html__( 'Below Carousel', 'biagiotti' ),
                    'inside-slider' => esc_html__( 'Inside Carousel', 'biagiotti' )
                ],
                'condition' => [
                    'slider_pagination' => array( 'yes' )
                ],
                'default'   => ''
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'product_info',
            [
                'label' => esc_html__( 'Product Info', 'biagiotti' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'display_title',
            [
                'label'     => esc_html__( 'Display Title', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

		$this->add_control(
			'product_info_skin',
			[
				'label'     => esc_html__( 'Product Info Skin', 'biagiotti' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'default' => esc_html__( 'Default', 'biagiotti' ),
					'light'   => esc_html__( 'Light', 'biagiotti' )
				],
				'condition' => [
					'info_position' => array( 'info-on-image' )
				],
				'default' => 'default'
			]
		);

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__( 'Title Tag', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_title_tag( false ),
                'condition' => [
                    'display_title' => array( 'yes' )
                ],
                'default'   => 'h4'
            ]
        );

        $this->add_control(
            'title_transform',
            [
                'label'     => esc_html__( 'Title Text Transform', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_text_transform_array( true ),
                'condition' => [
                    'display_title' => array( 'yes' )
                ],
            ]
        );

        $this->add_control(
            'display_category',
            [
                'label'   => esc_html__( 'Display Category', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false ),
                'default' => 'yes'
            ]
        );

		$this->add_control(
			'display_rating',
			[
				'label'   => esc_html__( 'Display Rating', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'display_price',
			[
				'label'   => esc_html__( 'Display Price', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);

        $this->add_control(
            'display_excerpt',
            [
                'label'   => esc_html__( 'Display Excerpt', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'       => esc_html__( 'Excerpt Length', 'biagiotti' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Number of characters', 'biagiotti' ),
                'condition'   => [
                    'display_excerpt' => array( 'yes' )
                ],
                'default'     => '20'
            ]
        );

        $this->add_control(
            'button_skin',
            [
                'label'     => esc_html__( 'Button Skin', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'default' => esc_html__( 'Default', 'biagiotti' ),
                    'light'   => esc_html__( 'Light', 'biagiotti' )
                ],
                'default'   => 'default'
            ]
        );

        $this->add_control(
            'shader_background_color',
            [
                'label' => esc_html__( 'Shader Background Color', 'biagiotti' ),
                'type'  => \Elementor\Controls_Manager::COLOR
            ]
        );

		$this->add_control(
			'info_bottom_text_align',
			[
				'label'     => esc_html__( 'Product Info Text Alignment', 'biagiotti' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'default' => esc_html__( 'Default', 'biagiotti' ),
					'left'    => esc_html__( 'Left', 'biagiotti' ),
					'center'  => esc_html__( 'Center', 'biagiotti' ),
					'right'   => esc_html__( 'Right', 'biagiotti' ),
				],
				'condition' => [
					'info_position' => array( 'info-below-image' )
				],
			]
		);

		$this->add_control(
			'info_top_margin',
			[
				'label'     => esc_html__( 'Product Info Top Margin (px)', 'biagiotti' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'info_position' => array( 'info-below-image' )
				],
			]
		);

		$this->add_control(
			'info_bottom_margin',
			[
				'label'     => esc_html__( 'Product Info Bottom Margin (px)', 'biagiotti' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'info_position' => array( 'info-below-image' )
				],
			]
		);

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

		$params['class_name']    = 'plc';

		$additional_params                   = array();
		$additional_params['holder_classes'] = $this->getHolderClasses( $params );
		$additional_params['holder_data']    = $this->getProductListCarouselDataAttributes( $params );

		$queryArray                        = $this->generateProductQueryArray( $params );
		$query_result                      = new \WP_Query( $queryArray );
		$additional_params['query_result'] = $query_result;

		$params['this_object'] = $this;

        echo biagiotti_mikado_get_woo_shortcode_module_template_part( 'templates/carousel', 'product-list-carousel', $params['info_position'], $params, $additional_params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses   = array();
		$holderClasses[] = 'mkdf-' . $params['space_between_items'] . '-space';
		$holderClasses[] = 'mkdf-' . $params['info_position'];
		$holderClasses[] = 'mkdf-product-info-' . $params['product_info_skin'];
		$holderClasses[] = $this->getCarouselClasses( $params );

		if ( ! empty( $params['button_skin'] ) ) {
			$holderClasses[] = 'mkdf-' . $params['button_skin'] . '-skin';
		}

		return implode( ' ', $holderClasses );
	}

	private function getCarouselClasses( $params ) {
		$carouselClasses   = array();
		$carouselClasses[] = ! empty( $params['slider_navigation_skin'] ) ? 'mkdf-nav-' . $params['slider_navigation_skin'] . '-skin' : '';
		$carouselClasses[] = ! empty( $params['slider_navigation_pos'] ) ? 'mkdf-nav-' . $params['slider_navigation_pos'] : '';
		$carouselClasses[] = ! empty( $params['slider_navigation_pos_arrow'] ) ? 'mkdf-nav-' . $params['slider_navigation_pos_arrow'] : '';
		$carouselClasses[] = ! empty( $params['slider_pagination_pos'] ) ? 'mkdf-pag-' . $params['slider_pagination_pos'] : '';
		$carouselClasses[] = ! empty( $params['slider_pagination_skin'] ) ? 'mkdf-pag-' . $params['slider_pagination_skin'] . '-skin' : '';

		return implode( ' ', $carouselClasses );
	}

	private function getProductListCarouselDataAttributes( $params ) {
		$slider_data = array();

		$slider_data['data-number-of-items']        = ! empty( $params['number_of_visible_items'] ) ? $params['number_of_visible_items'] : '1';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

		$slider_data['data-nav-size']               = 'big';

		return $slider_data;
	}

	public function generateProductQueryArray( $params ) {
		$queryArray = array(
			'post_status'         => 'publish',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $params['number_of_posts'],
			'orderby'             => $params['orderby'],
			'order'               => $params['order']
		);

		if ( $params['orderby'] === 'on-sale' ) {
			$queryArray['no_found_rows'] = 1;
			$queryArray['post__in']      = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		}

		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' ) {
			$queryArray['product_cat'] = $params['taxonomy_values'];
		}

		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' ) {
			$queryArray['product_tag'] = $params['taxonomy_values'];
		}

		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' ) {
			$idArray                = $params['taxonomy_values'];
			$ids                    = explode( ',', $idArray );
			$queryArray['orderby']  = 'post__in';
			$queryArray['post__in'] = $ids;
		}

		return $queryArray;
	}

	public function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}

		return implode( ';', $styles );
	}

	public function getShaderStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['shader_background_color'] ) ) {
			$styles[] = 'background-image: none';
			$styles[] = 'background-color: ' . $params['shader_background_color'];
		}

		return implode( ';', $styles );
	}

	public function getTextWrapperStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['info_bottom_text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['info_bottom_text_align'];
		}

		if ( $params['info_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['info_top_margin'] ) . 'px';
		}

		if ( $params['info_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . biagiotti_mikado_filter_px( $params['info_bottom_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiMikadoElementorProductListCarousel() );