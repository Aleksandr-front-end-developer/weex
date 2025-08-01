<?php

class BiagiottiMikadoElementorBlogSlider extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_blog_slider';
    }

    public function get_title() {
        return esc_html__( 'Blog Slider', 'biagiotti' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-blog-slider';
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
                'label'   => esc_html__( 'Number of Posts', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '-1'
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_query_order_by_array(),
                'default' => 'title'
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
            'category',
            [
                'label'       => esc_html__( 'Category', 'biagiotti' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'biagiotti' )
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'     => esc_html__( 'Image Size', 'biagiotti' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'options'   => [
                    'full'                       => esc_html__( 'Original', 'biagiotti' ),
                    'biagiotti_mikado_image_square'    => esc_html__( 'Square', 'biagiotti' ),
                    'biagiotti_mikado_image_landscape' => esc_html__( 'Landscape', 'biagiotti' ),
                    'biagiotti_mikado_image_portrait'  => esc_html__( 'Portrait', 'biagiotti' ),
                    'thumbnail'                  => esc_html__( 'Thumbnail', 'biagiotti' ),
                    'medium'                     => esc_html__( 'Medium', 'biagiotti' ),
                    'large'                      => esc_html__( 'Large', 'biagiotti' ),
                    'custom'                     => esc_html__( 'Custom', 'biagiotti' ),
                ],
                'default'   => 'full'
            ]
        );

		$this->add_control(
			'custom_image_width',
			[
				'label' => esc_html__( 'Custom Image Width (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'image_size' => array( 'custom' )
				],
			]
		);

		$this->add_control(
			'custom_image_height',
			[
				'label' => esc_html__( 'Custom Image Height (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'image_size' => array( 'custom' )
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'post_info',
            [
                'label' => esc_html__( 'Post Info', 'biagiotti' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Title Tag', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_title_tag( true ),
                'default' => 'h4'
            ]
        );

        $this->add_control(
            'title_transform',
            [
                'label'   => esc_html__( 'Title Text Transform', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_text_transform_array( true )
            ]
        );

		$this->add_control(
			'title_font_weight',
			[
				'label'   => esc_html__( 'Title Text Transform', 'biagiotti' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_font_weight_array( true )
			]
		);

        $this->add_control(
            'post_info_author',
            [
                'label'   => esc_html__( 'Enable Post Info Author', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true )
            ]
        );

        $this->add_control(
            'post_info_date',
            [
                'label'   => esc_html__( 'Enable Post Info Date', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true )
            ]
        );

        $this->add_control(
            'post_info_category',
            [
                'label'   => esc_html__( 'Enable Post Info Category', 'biagiotti' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true )
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

		$default_atts = array(
			'number_of_posts'     => '-1',
			'orderby'             => 'title',
			'order'               => 'ASC',
			'category'            => '',
			'image_size'          => 'full',
			'custom_image_width'  => '',
			'custom_image_height' => '',
			'title_tag'           => 'h4',
			'title_transform'     => '',
			'title_font_weight'   => '',
			'post_info_author'    => '',
			'post_info_date'      => '',
			'post_info_category'  => ''
		);

		$queryArray             = $this->generateBlogQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;

		$params['number_of_posts'] = ! empty( $params['number_of_posts'] ) ? $params['number_of_posts'] : $default_atts['number_of_posts'];
		$params['orderby']         = ! empty( $params['orderby'] ) ? $params['orderby'] : $default_atts['orderby'];
		$params['order']           = ! empty( $params['order'] ) ? $params['order'] : $default_atts['order'];
		$params['image_size']      = ! empty( $params['image_size'] ) ? $params['image_size'] : $default_atts['image_size'];
		$params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];

		$params['this_object'] = $this;

		$params['slider_data']    = $this->getSliderData( $params );

		ob_start();

		biagiotti_mikado_get_module_template_part( 'shortcodes/blog-slider/holder', 'blog', '', $params );

		$html = ob_get_contents();

		ob_end_clean();

		echo biagiotti_mikado_get_module_part($html);
    }

	public function generateBlogQueryArray( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['orderby'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option( 'sticky_posts' )
		);

		if ( ! empty( $params['category'] ) ) {
			$queryArray['category_name'] = $params['category'];
		}

		return $queryArray;
	}

	public function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}

		if ( ! empty( $params['title_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['title_font_weight'];
		}

		return implode( ';', $styles );
	}

	private function getSliderData( $params ) {
		$slider_data = array();

		$slider_data['data-number-of-items']   = '3';
		$slider_data['data-slider-margin']     = '30';
		$slider_data['data-enable-navigation'] = 'yes';

		return $slider_data;
	}

	/**
	 * Filter categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogListCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'biagiotti' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find categories by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function blogListCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get category
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {

				$category_slug = $category->slug;
				$category_title = $category->name;

				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'biagiotti' ) . ': ' . $category_title;
				}

				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiMikadoElementorBlogSlider() );