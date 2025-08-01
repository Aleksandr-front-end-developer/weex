<?php

namespace BiagiottiCore\CPT\Shortcodes\VideoButton;

use BiagiottiCore\Lib;

class VideoButton implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_video_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Video Button', 'biagiotti-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by BIAGIOTTI', 'biagiotti-core' ),
					'icon'                      => 'icon-wpb-video-button extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'biagiotti-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'video_link',
							'heading'    => esc_html__( 'Video Link', 'biagiotti-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'video_image',
							'heading'     => esc_html__( 'Video Image', 'biagiotti-core' ),
							'description' => esc_html__( 'Select image from media library', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'play_button_color',
							'heading'    => esc_html__( 'Play Button Color', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'play_button_bg_color',
							'heading'    => esc_html__( 'Play Button Background Color', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'play_button_size',
							'heading'    => esc_html__( 'Play Button Size (px)', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'play_button_width',
							'heading'    => esc_html__( 'Play Button Width/Height (px)', 'biagiotti-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'play_button_image',
							'heading'     => esc_html__( 'Play Button Custom Image', 'biagiotti-core' ),
							'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'biagiotti-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'play_button_hover_image',
							'heading'     => esc_html__( 'Play Button Custom Hover Image', 'biagiotti-core' ),
							'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'biagiotti-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'video_link'              => '#',
			'video_image'             => '',
			'play_button_color'       => '',
			'play_button_bg_color'    => '',
			'play_button_size'        => '',
			'play_button_width'       => '',
			'play_button_image'       => '',
			'play_button_hover_image' => ''
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['play_button_styles'] = $this->getPlayButtonStyles( $params );
		$params['play_icon_styles']   = $this->getPlayIconStyles( $params );

		$html = biagiotti_core_get_shortcode_module_template_part( 'templates/video-button', 'video-button', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['video_image'] ) ? 'mkdf-vb-has-img' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getPlayButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['play_button_color'] ) ) {
			$styles[] = 'color: ' . $params['play_button_color'];
		}

		if ( ! empty( $params['play_button_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['play_button_size'] ) . 'px';
		}

		if ( ! empty( $params['play_button_width'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['play_button_width'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

	private function getPlayIconStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['play_button_bg_color'] ) ) {
			$styles[] = 'background-color: ' . $params['play_button_bg_color'];
		}

		if ( ! empty( $params['play_button_width'] ) ) {
			$styles[] = 'width: ' . biagiotti_mikado_filter_px( $params['play_button_width'] ) . 'px';
			$styles[] = 'height: ' . biagiotti_mikado_filter_px( $params['play_button_width'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}