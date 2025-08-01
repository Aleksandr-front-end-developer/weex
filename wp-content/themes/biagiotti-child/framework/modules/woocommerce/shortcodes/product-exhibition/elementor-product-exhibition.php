<?php

class BiagiottiMikadoElementorProductExibition extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_product_exhibition';
    }

    public function get_title() {
        return esc_html__( 'Product Exhibition', 'biagiotti' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-product-exhibition';
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
            'orientation',
            [
                'label'   => esc_html__( 'Orientation', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''          => esc_html__( 'Default', 'biagiotti' ),
                    'left' 		=> esc_html__( 'Left', 'biagiotti' ),
                    'right'     => esc_html__( 'Right', 'biagiotti' ),
                ],
                'default' => ''
            ]
        );

		$this->add_control(
			'number_of_posts',
			[
				'label'   => esc_html__( 'Number of Posts', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '8'
			]
		);

		$this->add_control(
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'biagiotti' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_number_of_columns_array( true ),
				'default'   => 'four'
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
				'options' => biagiotti_mikado_get_query_order_by_array(),
				'default' => 'date'
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_query_order_array(),
				'default' => 'ASC'
			]
		);

		$this->add_control(
			'taxonomy_to_display',
			[
				'label'   => esc_html__( 'Choose Sorting Taxonomy', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'category'          => esc_html__( 'Category', 'biagiotti' ),
					'tag' 		=> esc_html__( 'Tag', 'biagiotti' ),
					'id'     => esc_html__( 'Id', 'biagiotti' ),
				],
				'default' => 'category'
			]
		);

		$this->add_control(
			'taxonomy_values',
			[
				'label'   => esc_html__( 'Enter Taxonomy Values', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma\'', 'biagiotti-core' )
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'     => esc_html__( 'Image Proportions', 'biagiotti' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'options'   => [
					''                       => esc_html__( 'Default', 'biagiotti' ),
					'full'                       => esc_html__( 'Original', 'biagiotti' ),
					'square'    => esc_html__( 'Square', 'biagiotti' ),
					'landscape' => esc_html__( 'Landscape', 'biagiotti' ),
					'portrait'  => esc_html__( 'Portrait', 'biagiotti' ),
					'medium'                 => esc_html__( 'Medium', 'biagiotti' ),
					'large'                  => esc_html__( 'Large', 'biagiotti' ),
					'woocommerce_single'     => esc_html__( 'Shop Single', 'biagiotti' ),
					'woocommerce_thumbnail'  => esc_html__( 'Shop Thumbnail', 'biagiotti' ),

				],
				'default'   => 'full'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'product_info_settings',
			[
				'label' => esc_html__( 'Product Info', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'display_title',
			[
				'label'   => esc_html__( 'Display Title', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ) ,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_title_tag( true ),
				'default' => 'h4',
				'condition' => [
					'display_title!' => ''
				],
			]
		);

		$this->add_control(
			'title_transform',
			[
				'label'   => esc_html__( 'Title Text Transform', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_text_transform_array( true ),
				'condition' => [
					'display_title!' => ''
				],
			]
		);

		$this->add_control(
			'display_category',
			[
				'label'   => esc_html__( 'Display Category', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ) ,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'display_price',
			[
				'label'   => esc_html__( 'Display Price', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ) ,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'display_rating',
			[
				'label'   => esc_html__( 'Display Rating', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ) ,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'display_excerpt',
			[
				'label'   => esc_html__( 'Display Excerpt', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ) ,
				'default' => 'no'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'product_info_style_settings',
			[
				'label' => esc_html__( 'Product Info Style', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_info_skin',
			[
				'label'   => esc_html__( 'Product Info Skin', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default'          => esc_html__( 'Default', 'biagiotti' ),
					'light' 		=> esc_html__( 'Light', 'biagiotti' ),
				],
				'default' => 'default'
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'   => esc_html__( 'Excerpt Length', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of characters', 'biagiotti-core' ),
				'condition' => [
					'display_excerpt' => 'yes'
				],
				'default' => '20'
			]
		);

		$this->add_control(
			'button_skin',
			[
				'label'   => esc_html__( 'Button Skin', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default'          => esc_html__( 'Default', 'biagiotti' ),
					'light' 		=> esc_html__( 'Light', 'biagiotti' ),
				],
				'default' => 'default'
			]
		);

		$this->add_control(
			'shader_background_color',
			[
				'label'     => esc_html__( 'Shader Background Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'main_section_settings',
			[
				'label' => esc_html__( 'Main Section', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'main_image',
			[
				'label'       => esc_html__( 'Main Image', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library', 'biagiotti-core' )
			]
		);

		$this->add_control(
			'main_title',
			[
				'label' => esc_html__( 'Main Title', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'main_title_tag',
			[
				'label'     => esc_html__( 'Main Title Tag', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   =>  biagiotti_mikado_get_title_tag( true),
				'default'	=> 'h2',
				'condition' => [
					'main_title!' => ''
				],
			]
		);

		$this->add_control(
			'tagline',
			[
				'label' => esc_html__( 'Tagline', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'tagline_tag',
			[
				'label'     => esc_html__( 'Main Title Tag', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   =>  biagiotti_mikado_get_title_tag( true, array(
					'div' => esc_html__( 'Stylized', 'biagiotti-core' )
				) ),
				'default'	=> 'div',
				'condition' => [
					'tagline!' => ''
				],
			]
		);

		$this->add_control(
			'tagline_margin',
			[
				'label'     => esc_html__( 'Tagline Bottom Margin (px)', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'tagline!' => ''
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'target',
			[
				'label'     => esc_html__( '\'Link Target', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   =>  biagiotti_mikado_get_link_target_array( true ),
				'default'	=> '_self',
				'condition' => [
					'link!' => ''
				],
			]
		);

        $this->end_controls_section();


    }

    public function render() {
        $params = $this->get_settings_for_display();

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['main_section_bg_styles'] = $this->getBackgroundImageStyles( $params['main_image']['id'] );
		$params['tagline_styles'] = $this->getTaglineStyles( $params );

        echo biagiotti_mikado_get_woo_shortcode_module_template_part( 'templates/product-exhibition', 'product-exhibition', '', $params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses   = array();

		$holderClasses[] = 'mkdf-' . $params['orientation'] . '-orientation';
		$holderClasses[] = 'mkdf-' . $params['space_between_items'] . '-offset';

		return implode( ' ', $holderClasses );
	}

	private function getBackgroundImageStyles( $image ) {
		$styles = array();

		if ( ! empty( $image ) ) {
			$image_original = wp_get_attachment_image_src( $image, 'full' );

			$styles[] = 'background-image: url(' . $image_original[0] . ')';
			$styles[] = 'background-repeat: no-repeat';
			$styles[] = 'background-size: cover';
		}

		return implode( ';', $styles );
	}

	private function getTaglineStyles( $params ) {
		$styles = array();

		if ( $params['tagline_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . biagiotti_mikado_filter_px( $params['tagline_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiMikadoElementorProductExibition() );