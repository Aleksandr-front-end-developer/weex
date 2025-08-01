<?php

class BiagiottiMikadoElementorProductListSimple extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_product_list_simple';
    }

    public function get_title() {
        return esc_html__( 'Product List - Simple', 'biagiotti' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-product-list-simple';
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
            'number_of_posts',
            [
                'label'       => esc_html__( 'Number of Products', 'biagiotti' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Number of products to show (default value is 4)', 'biagiotti' ),
                'default'     => '8'
            ]
        );

		$this->add_control(
			'number_of_columns',
			[
				'label'   => esc_html__( 'Number of Columns', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_number_of_columns_array( true ),
				'default' => 'four'
			]
		);

		$this->add_control(
			'space_between_items',
			[
				'label'   => esc_html__( 'Space Between Items', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_space_between_items_array(),
				'default' => 'normal'
			]
		);

        $this->add_control(
            'orderby',
            [
                'label'     => esc_html__( 'Order By', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_query_order_by_array(),
                'condition' => [
                    'type' => array( 'sale', 'featured')
                ],
                'default'   => 'title'
            ]
        );

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_query_order_array(),
				'order' => 'ASC'
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
            'display_title',
            [
                'label'   => esc_html__( 'Display Title', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__( 'Title Tag', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_title_tag( true ),
                'condition' => [
                    'display_title' => array( 'yes')
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
                    'display_title' => array( 'yes')
                ],
                'default'   => 'uppercase'
            ]
        );

		$this->add_control(
			'display_excerpt',
			[
				'label'   => esc_html__( 'Display Excerpt', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false ),
				'default' => 'yes'
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
				'default' => '20'
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
                'default' => 'no'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['class_name']     = 'pls';

		$params['title_styles'] = $this->getTitleStyles( $params );

		$queryArray             = $this->generateProductQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;

		echo biagiotti_mikado_get_woo_shortcode_module_template_part( 'templates/product-list-template', 'product-list-simple', '', $params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses   = array();
		$holderClasses[] = 'mkdf-' . $params['number_of_columns'] . '-columns';
		$holderClasses[] = 'mkdf-' . $params['space_between_items'] . '-space';

		return implode( ' ', $holderClasses );
	}

	private function generateProductQueryArray( $params ) {
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
			$queryArray['orderby'] = 'post__in';
			$queryArray['post__in'] = $ids;
		}

		return $queryArray;
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}

		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiMikadoElementorProductListSimple() );