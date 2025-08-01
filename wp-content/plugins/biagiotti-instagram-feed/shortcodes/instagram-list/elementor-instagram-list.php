<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class BiagiottiCoreElementorInstagramList extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_instagram_list';
	}

	public function get_title() {
		return esc_html__( 'Instagram List', 'biagiotti-instagram-feed' );
	}

	public function get_icon() {
		return 'biagiotti-elementor-custom-icon biagiotti-elementor-instagram-list';
	}

	public function get_categories() {
		return [ 'mikado' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'biagiotti-instagram-feed' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'type',
			[
				'label'   => esc_html__( 'Type', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'gallery'  => esc_html__( 'Gallery', 'biagiotti-instagram-feed' ),
					'carousel' => esc_html__( 'Carousel', 'biagiotti-instagram-feed' ),
				],
				'default' => 'gallery',
			]
		);

		$this->add_control(
			'number_of_columns',
			[
				'label'       => esc_html__( 'Number of Columns', 'biagiotti-instagram-feed' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					'1' => esc_html__( 'One', 'biagiotti-instagram-feed' ),
					'2' => esc_html__( 'Two', 'biagiotti-instagram-feed' ),
					'3' => esc_html__( 'Three', 'biagiotti-instagram-feed' ),
					'4' => esc_html__( 'Four', 'biagiotti-instagram-feed' ),
					'5' => esc_html__( 'Five', 'biagiotti-instagram-feed' ),
					'6' => esc_html__( 'Six', 'biagiotti-instagram-feed' ),
					'9' => esc_html__( 'Nine', 'biagiotti-instagram-feed' ),
				],
				'description' => esc_html__( 'Default value is Three', 'biagiotti-instagram-feed' ),
				'default'     => '3',
			]
		);

		$this->add_control(
			'space_between_columns',
			[
				'label'   => esc_html__( 'Space Between Items', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'medium' => esc_html__( 'Medium (20)', 'biagiotti-instagram-feed' ),
					'normal' => esc_html__( 'Normal (15)', 'biagiotti-instagram-feed' ),
					'small'  => esc_html__( 'Small (10)', 'biagiotti-instagram-feed' ),
					'tiny'   => esc_html__( 'Tiny (5)', 'biagiotti-instagram-feed' ),
					'micro'  => esc_html__( 'Micro (3)', 'biagiotti-instagram-feed' ),
					'no'     => esc_html__( 'No (0)', 'biagiotti-instagram-feed' ),
				],
				'default' => 'normal',
			]
		);

		$this->add_control(
			'number_of_photos',
			[
				'label'   => esc_html__( 'Number of Photos', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '-1',
			]
		);

		$this->add_control(
			'transient_time',
			[
				'label'   => esc_html__( 'Images Cache Time', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'show_instagram_icon',
			[
				'label'   => esc_html__( 'Show Instagram Icon', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false ),
				'default' => 'normal',
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'   => esc_html__( 'Image Size', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'thumbnail'           => esc_html__( 'Small', 'biagiotti-instagram-feed' ),
					'low_resolution'      => esc_html__( 'Medium', 'biagiotti-instagram-feed' ),
					'standard_resolution' => esc_html__( 'Large', 'biagiotti-instagram-feed' ),
				],
				'default' => 'thumbnail',
			]
		);

		$this->add_control(
			'show_instagram_info',
			[
				'label'   => esc_html__( 'Show Instagram Info', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false ),
				'default' => 'no',
			]
		);

		$this->add_control(
			'tagline',
			[
				'label'     => esc_html__( 'Tagline', 'biagiotti-instagram-feed' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_instagram_info' => array( 'yes' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'biagiotti-instagram-feed' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_instagram_info' => array( 'yes' ),
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'     => esc_html__( 'Subtitle', 'biagiotti-instagram-feed' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_instagram_info' => array( 'yes' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_settings',
			[
				'label' => esc_html__( 'Slider Settings', 'biagiotti-instagram-feed' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label'   => esc_html__( 'Enable Slider Loop', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, false ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label'   => esc_html__( 'Enable Slider Autoplay', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label'       => esc_html__( 'Slide Duration', 'biagiotti-instagram-feed' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default value is 5000 (ms)', 'biagiotti-instagram-feed' ),
				'default'     => '5000',
			]
		);

		$this->add_control(
			'slider_speed_animation',
			[
				'label'       => esc_html__( 'Slide Animation Duration', 'biagiotti-instagram-feed' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'biagiotti-instagram-feed' ),
				'default'     => '600',
			]
		);

		$this->add_control(
			'slider_navigation',
			[
				'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'slider_navigation_skin',
			[
				'label'     => esc_html__( 'Navigation Skin', 'biagiotti-instagram-feed' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''      => esc_html__( 'Default', 'biagiotti-instagram-feed' ),
					'light' => esc_html__( 'Light', 'biagiotti-instagram-feed' ),
				],
				'condition' => [
					'slider_navigation' => array( 'yes' ),
				],
				'default'   => '',
			]
		);

		$this->add_control(
			'slider_navigation_pos',
			[
				'label'     => esc_html__( 'Navigation Skin', 'biagiotti-instagram-feed' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''        => esc_html__( 'Default', 'biagiotti-instagram-feed' ),
					'outside' => esc_html__( 'Outside of Content', 'biagiotti-instagram-feed' ),
				],
				'condition' => [
					'slider_navigation' => array( 'yes' ),
				],
				'default'   => '',
			]
		);

		$this->add_control(
			'slider_pagination',
			[
				'label'   => esc_html__( 'Enable Slider Pagination', 'biagiotti-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
				'default' => 'no',
			]
		);

		$this->add_control(
			'slider_pagination_skin',
			[
				'label'     => esc_html__( 'Pagination Skin', 'biagiotti-instagram-feed' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''      => esc_html__( 'Default', 'biagiotti-instagram-feed' ),
					'light' => esc_html__( 'Light', 'biagiotti-instagram-feed' ),
				],
				'condition' => [
					'enable_pagination' => array( 'yes' ),
				],
				'default'   => '',
			]
		);

		$this->end_controls_section();
	}

	public function render() {

		$params = $this->get_settings_for_display();

		$params['outer_classes']  = $this->get_outer_classes( $params );
		$params['holder_classes'] = $this->get_holder_classes( $params );

		$instagram_api           = new \BiagiottiInstagramApi();
		$params['instagram_api'] = $instagram_api;

		$images_array = $instagram_api->get_images(
			$params['number_of_photos'],
			array(
				'use_transients' => true,
				'transient_name' => wp_rand( 0, 1000 ),
				'transient_time' => $params['transient_time'],
			)
		);

		$params['images_array'] = $images_array;
		$params['data_attr']    = $this->get_slider_data( $params );

		// Get HTML from template based on type of team.
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$instagram_template_part = biagiotti_instagram_get_shortcode_module_template_part( 'templates/holder', 'instagram-list', '', $params );
		echo do_shortcode( $instagram_template_part );
	}

	public function get_outer_classes( $params ) {
		$outer_classes = array();

		$outer_classes[] = ! empty( $params['slider_navigation_skin'] ) ? 'mkdf-nav-' . $params['slider_navigation_skin'] . '-skin' : '';
		$outer_classes[] = ! empty( $params['slider_navigation_pos'] ) ? 'mkdf-instagram-arrow-' . $params['slider_navigation_pos'] . '-pos' : '';
		$outer_classes[] = ! empty( $params['slider_pagination_skin'] ) ? 'mkdf-pag-' . $params['slider_pagination_skin'] . '-skin' : '';

		return implode( ' ', $outer_classes );
	}

	public function get_holder_classes( $params ) {
		$holder_classes = array();

		$holder_classes[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-col-' . $params['number_of_columns'] : 'mkdf-col-3';
		$holder_classes[] = ! empty( $params['space_between_columns'] ) ? 'mkdf-' . $params['space_between_columns'] . '-space' : 'mkdf-normal-space';

		if ( 'carousel' === $params['type'] ) {
			$holder_classes[] = 'mkdf-instagram-carousel mkdf-owl-slider';

		} elseif ( 'gallery' === $params['type'] ) {
			$holder_classes[] = 'mkdf-instagram-gallery';
		}

		return implode( ' ', $holder_classes );
	}

	private function get_slider_data( $params ) {
		$slider_data = array();

		$slider_data['data-number-of-items']        = $params['number_of_columns'];
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

		$slider_margin = 0;
		if ( 'medium' === $params['space_between_columns'] ) {
			$slider_margin = 40;
		} elseif ( 'normal' === $params['space_between_columns'] ) {
			$slider_margin = 30;
		} elseif ( 'small' === $params['space_between_columns'] ) {
			$slider_margin = 20;
		} elseif ( 'tiny' === $params['space_between_columns'] ) {
			$slider_margin = 10;
		} elseif ( 'micro' === $params['space_between_columns'] ) {
			$slider_margin = 6;
		} elseif ( 'no' === $params['space_between_columns'] ) {
			$slider_margin = 0;
		}

		$slider_data['data-slider-margin'] = esc_attr( $slider_margin );

		return $slider_data;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorInstagramList() );
