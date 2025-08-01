<?php

namespace BiagiottiInstagram\Shortcodes\InstagramList;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use BiagiottiInstagram\Lib;

class InstagramList implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_instagram_list';

		add_action( 'vc_before_init', array( $this, 'vc_map' ) );
	}

	public function get_base() {
		return $this->base;
	}

	public function vc_map() {
		if ( function_exists( 'vc_map' ) ) {
			$group_label = esc_html__( 'Slider Settings', 'biagiotti-instagram-feed' );
			vc_map(
				array(
					'name'                      => esc_html__( 'Instagram List', 'biagiotti-instagram-feed' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by BIAGIOTTI', 'biagiotti-instagram-feed' ),
					'icon'                      => 'icon-wpb-instagram-list extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'param_name' => 'type',
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Type', 'biagiotti-instagram-feed' ),
							'value'      => array(
								esc_html__( 'Gallery', 'biagiotti-instagram-feed' )  => 'gallery',
								esc_html__( 'Carousel', 'biagiotti-instagram-feed' ) => 'carousel',
							),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'biagiotti-instagram-feed' ),
							'value'       => array(
								esc_html__( 'One', 'biagiotti-instagram-feed' )   => '1',
								esc_html__( 'Two', 'biagiotti-instagram-feed' )   => '2',
								esc_html__( 'Three', 'biagiotti-instagram-feed' ) => '3',
								esc_html__( 'Four', 'biagiotti-instagram-feed' )  => '4',
								esc_html__( 'Five', 'biagiotti-instagram-feed' )  => '5',
								esc_html__( 'Six', 'biagiotti-instagram-feed' )   => '6',
								esc_html__( 'Nine', 'biagiotti-instagram-feed' )  => '9',
							),
							'save_always' => true,
						),
						array(
							'param_name'  => 'space_between_columns',
							'type'        => 'dropdown',
							'heading'     => esc_html__( 'Space Between Items', 'biagiotti-instagram-feed' ),
							'value'       => array(
								esc_html__( 'Medium (20)', 'biagiotti-instagram-feed' ) => 'medium',
								esc_html__( 'Normal (15)', 'biagiotti-instagram-feed' ) => 'normal',
								esc_html__( 'Small (10)', 'biagiotti-instagram-feed' )  => 'small',
								esc_html__( 'Tiny (5)', 'biagiotti-instagram-feed' )    => 'tiny',
								esc_html__( 'Micro (3)', 'biagiotti-instagram-feed' )   => 'micro',
								esc_html__( 'No (0)', 'biagiotti-instagram-feed' )      => 'no',
							),
							'save_always' => true,
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_photos',
							'heading'    => esc_html__( 'Number of Photos', 'biagiotti-instagram-feed' ),
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'transient_time',
							'heading'     => esc_html__( 'Images Cache Time', 'biagiotti-instagram-feed' ),
							'value'       => '10800',
							'save_always' => true,
						),

						array(
							'param_name' => 'show_instagram_icon',
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Show Instagram Icon', 'biagiotti-instagram-feed' ),
							'value'      => array_flip( biagiotti_mikado_get_yes_no_select_array( false ) ),
						),
						array(
							'param_name' => 'show_instagram_info',
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Show Instagram Info', 'biagiotti-instagram-feed' ),
							'value'      => array_flip( biagiotti_mikado_get_yes_no_select_array( false ) ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'tagline',
							'heading'    => esc_html__( 'Tagline', 'biagiotti-instagram-feed' ),
							'dependency' => array(
								'element' => 'show_instagram_info',
								'value'   => array( 'yes' ),
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'biagiotti-instagram-feed' ),
							'dependency' => array(
								'element' => 'show_instagram_info',
								'value'   => array( 'yes' ),
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle',
							'heading'    => esc_html__( 'Subtitle', 'biagiotti-instagram-feed' ),
							'dependency' => array(
								'element' => 'show_instagram_info',
								'value'   => array( 'yes' ),
							),
						),

						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'biagiotti-instagram-feed' ),
							'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => $group_label,
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'biagiotti-instagram-feed' ),
							'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => $group_label,
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'biagiotti-instagram-feed' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'biagiotti-instagram-feed' ),
							'group'       => $group_label,
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'biagiotti-instagram-feed' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'biagiotti-instagram-feed' ),
							'group'       => $group_label,
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'biagiotti-instagram-feed' ),
							'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => $group_label,
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_navigation_skin',
							'heading'    => esc_html__( 'Slider Navigation Skin', 'biagiotti-instagram-feed' ),
							'value'      => array(
								esc_html__( 'Default', 'biagiotti-instagram-feed' ) => 'default',
								esc_html__( 'Light', 'biagiotti-instagram-feed' )   => 'light',
							),
							'dependency' => array(
								'element' => 'slider_navigation',
								'value'   => array( 'yes' ),
							),
							'group'      => $group_label,
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_navigation_pos',
							'heading'    => esc_html__( 'Slider Navigation Arrows Position', 'biagiotti-instagram-feed' ),
							'value'      => array(
								esc_html__( 'Default', 'biagiotti-instagram-feed' )            => '',
								esc_html__( 'Outside of Content', 'biagiotti-instagram-feed' ) => 'outside',
							),
							'dependency' => array(
								'element' => 'slider_navigation',
								'value'   => array( 'yes' ),
							),
							'group'      => $group_label,
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'biagiotti-instagram-feed' ),
							'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, false ) ),
							'save_always' => true,
							'group'       => $group_label,
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_pagination_skin',
							'heading'    => esc_html__( 'Slider Pagination Skin', 'biagiotti-instagram-feed' ),
							'value'      => array(
								esc_html__( 'Default', 'biagiotti-instagram-feed' ) => 'default',
								esc_html__( 'Light', 'biagiotti-instagram-feed' )   => 'light',
							),
							'dependency' => array(
								'element' => 'slider_pagination',
								'value'   => array( 'yes' ),
							),
							'group'      => $group_label,
						),
					),
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_columns'      => '3',
			'space_between_columns'  => 'normal',
			'number_of_photos'       => '',
			'transient_time'         => '',
			'show_instagram_icon'    => 'no',
			'type'                   => 'gallery',
			'show_instagram_info'    => 'no',
			'tagline'                => '',
			'title'                  => '',
			'subtitle'               => '',
			'slider_loop'            => 'yes',
			'slider_autoplay'        => 'yes',
			'slider_speed'           => '5000',
			'slider_speed_animation' => '600',
			'slider_navigation'      => 'yes',
			'slider_navigation_skin' => '',
			'slider_navigation_pos'  => '',
			'slider_pagination'      => 'no',
			'slider_pagination_skin' => '',
		);
		$params = shortcode_atts( $args, $atts );

		$params['show_instagram_info'] = ! empty( $params['show_instagram_info'] ) ? $params['show_instagram_info'] : $args['show_instagram_info'];

		// phpcs:ignore WordPress.PHP.DontExtract.extract_extract
		extract( $params, EXTR_SKIP );

		$params['outer_classes']  = $this->get_outer_classes( $params );
		$params['holder_classes'] = $this->get_holder_classes( $params );

		$instagram_api           = new \BiagiottiInstagramApi();
		$params['instagram_api'] = $instagram_api;

		$images_array = $instagram_api->get_images(
			$params['number_of_photos'],
			array(
				'use_transients' => true,
				'transient_name' => '_biagiotti_instagram_api_transient_name',
				'transient_time' => $params['transient_time'],
			)
		);

		$params['images_array'] = $images_array;
		$params['data_attr']    = $this->get_slider_data( $params );

		// Get HTML from template based on type of team.
		return biagiotti_instagram_get_shortcode_module_template_part( 'templates/holder', 'instagram-list', '', $params );
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
