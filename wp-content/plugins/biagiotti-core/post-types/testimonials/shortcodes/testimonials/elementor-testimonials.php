<?php

class BiagiottiCoreElementoryTestimonials extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_testimonials';
    }

    public function get_title() {
        return esc_html__( 'Testimonials', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-testimonials';
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
            'type',
            [
                'label'   => esc_html__( 'Type', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'standard'         => esc_html__( 'Standard', 'biagiotti-core' ),
                    'carousel'         => esc_html__( 'Carousel', 'biagiotti-core' ),
                ],
				'default' => 'standard'
            ]
        );

        $this->add_control(
            'skin',
            [
                'label'   => esc_html__( 'Skin', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''      => esc_html__( 'Default', 'biagiotti-core' ),
                    'light' => esc_html__( 'Light', 'biagiotti-core' ),
                ],
				'default' => ''
            ]
        );

        $this->add_control(
            'number',
            [
                'label'   => esc_html__( 'Number of Testimonials', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '-1'
            ]
        );

        $this->add_control(
            'category',
            [
                'label'   => esc_html__( 'Category', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'biagiotti-core' )

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
            'slider_loop',
            [
                'label'   => esc_html__( 'Enable Slider Loop', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_autoplay',
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
                'label'   => esc_html__( 'Enable Slider Autoplay', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default value is 5000 (ms)', 'biagiotti-core' ),
                'default' => '5000'
            ]
        );

        $this->add_control(
            'slider_speed_animation',
            [
                'label'   => esc_html__( 'Slide Animation Duration', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'biagiotti-core' ),
                'default' => '600'
            ]
        );

        $this->add_control(
            'slider_navigation',
            [
                'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'condition' => [
                    'type' => array( 'standard' )
                ],
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_pagination',
            [
                'label'   => esc_html__( 'Enable Slider Pagination', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'condition' => [
					'type' => array( 'standard' )
                ],
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

		$params['holder_classes'] = $this->getHolderClasses( $params );

		$params['query_args']    = $this->getQueryParams( $params );
		$params['query_results'] = new \WP_Query( $params['query_args'] );

		$params['data_attr'] = $this->getSliderData( $params );

        echo biagiotti_core_get_cpt_shortcode_module_template_part( 'testimonials', 'testimonials', 'testimonials-' . $params['type'], '', $params );

    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = 'mkdf-testimonials-' . $params['type'];
		$holderClasses[] = ! empty( $params['skin'] ) ? 'mkdf-testimonials-' . $params['skin'] : '';

		return implode( ' ', $holderClasses );
	}

	private function getQueryParams( $params ) {
		$args = array(
			'post_status'    => 'publish',
			'post_type'      => 'testimonials',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => $params['number']
		);

		if ( $params['category'] != '' ) {
			$args['testimonials-category'] = $params['category'];
		}

		return $args;
	}

	private function getSliderData( $params ) {
		$slider_data = array();

		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

		return $slider_data;
	}

	/**
	 * Filter testimonials categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function testimonialsCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS testimonials_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'testimonials-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['testimonials_category_title'] ) > 0 ) ? esc_html__( 'Category', 'biagiotti-core' ) . ': ' . $value['testimonials_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;

	}

	/**
	 * Find testimonials category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function testimonialsCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$testimonials_category = get_term_by( 'slug', $query, 'testimonials-category' );
			if ( is_object( $testimonials_category ) ) {

				$testimonials_category_slug  = $testimonials_category->slug;
				$testimonials_category_title = $testimonials_category->name;

				$testimonials_category_title_display = '';
				if ( ! empty( $testimonials_category_title ) ) {
					$testimonials_category_title_display = esc_html__( 'Category', 'biagiotti-core' ) . ': ' . $testimonials_category_title;
				}

				$data          = array();
				$data['value'] = $testimonials_category_slug;
				$data['label'] = $testimonials_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementoryTestimonials() );