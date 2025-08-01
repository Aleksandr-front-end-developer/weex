<?php

class BiagiottiCoreElementorPortfolioCategoryList extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_portfolio_category_list';
    }

    public function get_title() {
        return esc_html__( 'Portfolio Category List', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-portfolio-category-list';
    }

    public function get_categories() {
        return [ 'mikado' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'biagiotti-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_columns',
            [
                'label'       => esc_html__( 'Number of Columns', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => biagiotti_mikado_get_number_of_columns_array( true, array( 'one' ) ),
                'description' => esc_html__( 'Default value is Three', 'biagiotti-core' ),
                'default'     => 'three'
            ]
        );

        $this->add_control(
            'space_between_items',
            [
                'label'   => esc_html__( 'Space Between Items', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_space_between_items_array(),
                'default' => 'normal'
            ]
        );

        $this->add_control(
            'number_of_items',
            [
                'label'       => esc_html__( 'Number of Items Per Page', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => biagiotti_mikado_get_space_between_items_array(),
                'description' => esc_html__( 'Set number of items for your portfolio category list. Default value is 6', 'biagiotti-core' ),
                'default'     => '6'
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_query_order_by_array(),
                'default' => 'date'
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_query_order_array(),
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'image_proportions',
            [
                'label'       => esc_html__( 'Image Proportions', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => [
                    'full'      => esc_html__( 'Original', 'biagiotti-core' ),
                    'square'    => esc_html__( 'Square', 'biagiotti-core' ),
                    'landscape' => esc_html__( 'Landscape', 'biagiotti-core' ),
                    'portrait'  => esc_html__( 'Portrait', 'biagiotti-core' ),
                    'medium'    => esc_html__( 'Medium', 'biagiotti-core' ),
                    'large'     => esc_html__( 'Large', 'biagiotti-core' ),
                    'custom'     => esc_html__( 'Custom', 'biagiotti-core' ),
                ],
                'description' => esc_html__( 'Set image proportions for your portfolio category list', 'biagiotti-core' ),
                'default'     => 'full'
            ]
        );

		$this->add_control(
			'custom_image_width',
			[
				'label' => esc_html__( 'Custom Image Width (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'image_proportions' => array( 'custom' )
				],
			]
		);

		$this->add_control(
			'custom_image_height',
			[
				'label' => esc_html__( 'Custom Image Height (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'image_proportions' => array( 'custom' )
				],
			]
		);

        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Title Tag', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_title_tag( true ),
                'default' => 'h4'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

		$query_array              = $this->getQueryArray( $params );
		$params['query_results']  = get_terms( $query_array );
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['image_size']     = $this->getImageSize( $params );

        echo biagiotti_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'portfolio-category-holder', '', $params );
    }

	public function getQueryArray( $params ) {
		$query_array = array(
			'taxonomy'   => 'portfolio-category',
			'number'     => $params['number_of_items'],
			'orderby'    => $params['orderby'],
			'order'      => $params['order'],
			'hide_empty' => true
		);

		return $query_array;
	}

	public function getHolderClasses( $params ) {
		$classes = array();

		$classes[] = 'mkdf-' . $params['number_of_columns'] . '-columns';
		$classes[] = 'mkdf-' . $params['space_between_items'] . '-space' ;

		return implode( ' ', $classes );
	}

	public function getImageSize( $params ) {
		$thumb_size = 'full';

		if ( ! empty( $params['image_proportions'] ) ) {
			$image_size = $params['image_proportions'];

			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'biagiotti_mikado_image_landscape';
					break;
				case 'portrait':
					$thumb_size = 'biagiotti_mikado_image_portrait';
					break;
				case 'square':
					$thumb_size = 'biagiotti_mikado_image_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
				case 'custom':
					$thumb_size = 'custom';
					break;
			}
		}

		return $thumb_size;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorPortfolioCategoryList() );