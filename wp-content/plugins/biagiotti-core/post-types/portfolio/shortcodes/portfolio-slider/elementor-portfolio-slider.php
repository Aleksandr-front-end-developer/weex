<?php

class BiagiottiCoreElementorPortfolioSlider extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_portfolio_slider';
    }

    public function get_title() {
        return esc_html__( 'Portfolio Slider', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-portfolio-slider';
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
            'number_of_items',
            [
                'label'       => esc_html__( 'Number of Portfolios Per Page', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Set number of items for your portfolio list. Enter -1 to show all.', 'biagiotti-core' ),
                'default'     => '9'
            ]
        );

        $this->add_control(
            'item_type',
            [
                'label'   => esc_html__( 'Click Behavior', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''        => esc_html__( 'Open portfolio single page on click', 'biagiotti-core' ),
                    'gallery' => esc_html__( 'Open gallery in Pretty Photo on click', 'biagiotti-core' ),
                ],
				'default'     => ''
            ]
        );

        $this->add_control(
            'number_of_columns',
            [
                'label'       => esc_html__( 'Number of Columns', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => biagiotti_mikado_get_number_of_columns_array( true ),
                'description' => esc_html__( 'Default value is One', 'biagiotti-core' ),
                'default'     => 'four'
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
                'description' => esc_html__( 'Set image proportions for your portfolio list.', 'biagiotti-core' ),
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
            'category',
            [
                'label'       => esc_html__( 'One-Category Portfolio List', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'selected_projects',
            [
                'label'       => esc_html__( 'Show Only Projects with Listed IDs', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'tag',
            [
                'label'       => esc_html__( 'One-Tag Portfolio List', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'biagiotti-core' )
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

        $this->end_controls_section();

        $this->start_controls_section(
            'content_layout',
            [
                'label' => esc_html__( 'Content Layout', 'biagiotti-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'item_style',
            [
                'label'   => esc_html__( 'Item Style', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'standard-shader'                 => esc_html__( 'Standard - Shader', 'biagiotti-core' ),
                    'standard-switch-images'          => esc_html__( 'Standard - Switch Featured Images', 'biagiotti-core' ),
					'gallery-overlay'                 => esc_html__( 'Gallery - Overlay', 'biagiotti-core' ),
                ],
                'default' => 'standard-shader'
            ]
        );

        $this->add_control(
            'content_top_margin',
            [
                'label'     => esc_html__( 'Content Top Margin (px or %)', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'item_style' => array( 'standard-shader', 'standard-switch-images' )
                ],
            ]
        );

        $this->add_control(
            'content_bottom_margin',
            [
                'label'     => esc_html__( 'Content Bottom Margin (px or %)', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'item_style' => array( 'standard-shader', 'standard-switch-images' )
                ],
            ]
        );

        $this->add_control(
            'enable_title',
            [
                'label'   => esc_html__( 'Enable Title', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__( 'Title Tag', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_title_tag( true ),
                'condition' => [
                    'enable_title' => array( 'yes' )
                ],
                'default'   => 'h4'
            ]
        );

        $this->add_control(
            'title_text_transform',
            [
                'label'     => esc_html__( 'Title Text Transform', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_text_transform_array( true ),
                'condition' => [
                    'enable_title' => array( 'yes' )
                ],
            ]
        );

        $this->add_control(
            'enable_category',
            [
                'label'   => esc_html__( 'Enable Category', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'enable_count_images',
            [
                'label'     => esc_html__( 'Enable Number of Images', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'condition' => [
                    'type' => array( 'gallery' )
                ],
                'default'   => 'yes'
            ]
        );

        $this->add_control(
            'enable_excerpt',
            [
                'label'   => esc_html__( 'Enable Excerpt', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'       => esc_html__( 'Excerpt Length', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Number of characters', 'biagiotti-core' ),
                'condition'   => [
                    'enable_excerpt' => array( 'yes' )
                ],
                'default'     => '20'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_settings',
            [
                'label' => esc_html__( 'Slider Settings', 'biagiotti-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_loop',
            [
                'label'     => esc_html__( 'Enable Slider Loop', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_yes_no_select_array( false, false ),
                'condition' => [
                    'item_type' => array( '' )
                ],
                'default'   => 'no'
            ]
        );

        $this->add_control(
            'enable_autoplay',
            [
                'label'   => esc_html__( 'Enable Slider Autoplay', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'       => esc_html__( 'Slide Duration', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default value is 5000 (ms)', 'biagiotti-core' ),
                'default'     => '5000'
            ]
        );

        $this->add_control(
            'slider_speed_animation',
            [
                'label'       => esc_html__( 'Slide Animation Duration', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'biagiotti-core' ),
                'default'     => '600'
            ]
        );

        $this->add_control(
            'enable_navigation',
            [
                'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'navigation_skin',
            [
                'label'     => esc_html__( 'Navigation Skin', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    ''      => esc_html__( 'Default', 'biagiotti-core' ),
                    'light' => esc_html__( 'Light', 'biagiotti-core' ),
                    'dark'  => esc_html__( 'Dark', 'biagiotti-core' )
                ],
                'condition' => [
                    'enable_navigation' => array( 'yes' )
                ],
                'default'   => ''
            ]
        );

		$this->add_control(
			'navigation_position',
			[
				'label'     => esc_html__( 'Navigation Skin', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''      => esc_html__( 'Inside Carousel', 'biagiotti-core' ),
					'outside-slider' => esc_html__( 'Outside Slider', 'biagiotti-core' ),

				],
				'condition' => [
					'enable_navigation' => array( 'yes' )
				],
				'default'   => ''
			]
		);

        $this->add_control(
            'enable_pagination',
            [
                'label'   => esc_html__( 'Enable Slider Pagination', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'pagination_skin',
            [
                'label'     => esc_html__( 'Pagination Skin', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    ''      => esc_html__( 'Default', 'biagiotti-core' ),
                    'light' => esc_html__( 'Light', 'biagiotti-core' ),
                    'dark'  => esc_html__( 'Dark', 'biagiotti-core' )
                ],
                'condition' => [
                    'enable_pagination' => array( 'yes' )
                ],
                'default'   => ''
            ]
        );

        $this->add_control(
            'pagination_position',
            [
                'label'     => esc_html__( 'Pagination Position', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'below-slider' => esc_html__( 'Below Slider', 'biagiotti-core' ),
                    'on-slider'    => esc_html__( 'On Slider', 'biagiotti-core' ),
                ],
                'condition' => [
                    'enable_pagination' => array( 'yes' )
                ],
                'default'   => 'below-slider'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {

		$params = $this->get_settings_for_display();

		$params['type']                = 'gallery';
		$params['portfolio_slider_on'] = 'yes';

		$html = '<div class="mkdf-portfolio-slider-holder">';
		$html .= biagiotti_mikado_execute_shortcode( 'mkdf_portfolio_list', $params );
		$html .= '</div>';

        echo biagiotti_mikado_get_module_part( $html );
    }

	/**
	 * Filter portfolio categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'biagiotti-core' ) . ': ' . $value['portfolio_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
			if ( is_object( $portfolio_category ) ) {

				$portfolio_category_slug  = $portfolio_category->slug;
				$portfolio_category_title = $portfolio_category->name;

				$portfolio_category_title_display = '';
				if ( ! empty( $portfolio_category_title ) ) {
					$portfolio_category_title_display = esc_html__( 'Category', 'biagiotti-core' ) . ': ' . $portfolio_category_title;
				}

				$data          = array();
				$data['value'] = $portfolio_category_slug;
				$data['label'] = $portfolio_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'biagiotti-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'biagiotti-core' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$portfolio = get_post( (int) $query );
			if ( ! is_wp_error( $portfolio ) ) {

				$portfolio_id    = $portfolio->ID;
				$portfolio_title = $portfolio->post_title;

				$portfolio_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$portfolio_title_display = ' - ' . esc_html__( 'Title', 'biagiotti-core' ) . ': ' . $portfolio_title;
				}

				$portfolio_id_display = esc_html__( 'Id', 'biagiotti-core' ) . ': ' . $portfolio_id;

				$data          = array();
				$data['value'] = $portfolio_id;
				$data['label'] = $portfolio_id_display . $portfolio_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter portfolio tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'biagiotti-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
			if ( is_object( $portfolio_tag ) ) {

				$portfolio_tag_slug  = $portfolio_tag->slug;
				$portfolio_tag_title = $portfolio_tag->name;

				$portfolio_tag_title_display = '';
				if ( ! empty( $portfolio_tag_title ) ) {
					$portfolio_tag_title_display = esc_html__( 'Tag', 'biagiotti-core' ) . ': ' . $portfolio_tag_title;
				}

				$data          = array();
				$data['value'] = $portfolio_tag_slug;
				$data['label'] = $portfolio_tag_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorPortfolioSlider() );