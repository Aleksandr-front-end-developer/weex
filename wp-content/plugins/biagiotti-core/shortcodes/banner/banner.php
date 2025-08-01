<?php

namespace BiagiottiCore\CPT\Shortcodes\Banner;

use BiagiottiCore\Lib;

class Banner implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_banner';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Banner', 'biagiotti-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by BIAGIOTTI', 'biagiotti-core' ),
					'icon'                      => 'icon-wpb-banner extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'biagiotti-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'biagiotti-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'biagiotti-core' ),
							'description' => esc_html__( 'Select image from media library', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'overlay_color',
							'heading'    => esc_html__( 'Image Overlay Color', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'hover_behavior',
							'heading'     => esc_html__( 'Hover Behavior', 'biagiotti-core' ),
							'value'       => array(
								esc_html__( 'Visible on Hover', 'biagiotti-core' )   => 'mkdf-visible-on-hover',
								esc_html__( 'Visible on Default', 'biagiotti-core' ) => 'mkdf-visible-on-default',
								esc_html__( 'Disabled', 'biagiotti-core' )           => 'mkdf-disabled'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'info_position',
							'heading'     => esc_html__( 'Info Position', 'biagiotti-core' ),
							'value'       => array(
								esc_html__( 'Default', 'biagiotti-core' )  => 'default',
								esc_html__( 'Centered', 'biagiotti-core' ) => 'centered',
								esc_html__( 'Right', 'biagiotti-core' )    => 'right',
								esc_html__( 'Top', 'biagiotti-core' )    => 'top'
							),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'info_content_padding',
							'heading'     => esc_html__( 'Info Content Padding', 'biagiotti-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'info_border_display',
							'heading'     => esc_html__( 'Info Border Display', 'biagiotti-core' ),
							'value'       => array(
								esc_html__( 'Yes', 'biagiotti-core' ) => 'yes',
								esc_html__( 'No', 'biagiotti-core' )  => 'no'
							),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'info_border_color',
							'heading'    => esc_html__( 'Info Content Border Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'info_border_display', 'value' => array( 'yes' ) )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'custom_title',
							'heading'    => esc_html__( 'Custom Title', 'biagiotti-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_title_padding',
							'heading'     => esc_html__( 'Custom Title Padding', 'biagiotti-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left', 'biagiotti-core' ),
							'dependency'  => array( 'element' => 'custom_title', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'custom_title_tag',
							'heading'     => esc_html__( 'Custom Title Tag', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'custom_title', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_title_font_size',
							'heading'     => esc_html__( 'Custom Title Font Size (px)', 'biagiotti-core' ),
							'dependency'  => array( 'element' => 'custom_title', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_title_line_height',
							'heading'     => esc_html__( 'Custom Title Line Height (px)', 'biagiotti-core' ),
							'dependency'  => array( 'element' => 'custom_title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'custom_title_color',
							'heading'    => esc_html__( 'Custom Title Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'custom_title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_light_words',
							'heading'     => esc_html__( 'Words with Light Font Weight', 'biagiotti-core' ),
							'description' => esc_html__( 'Enter the positions of the words you would like to display in a "light" font weight. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a light font weight, you would enter "1,3,4")', 'biagiotti-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title_top_margin',
							'heading'    => esc_html__( 'Title Top Margin (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle',
							'heading'    => esc_html__( 'Subtitle', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'subtitle_tag',
							'heading'     => esc_html__( 'Subtitle Tag', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_title_tag( true, array( 'span' => esc_html__( 'Custom Heading' ) ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'subtitle', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'subtitle_color',
							'heading'    => esc_html__( 'Subtitle Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Link', 'biagiotti-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'target',
							'heading'    => esc_html__( 'Target', 'biagiotti-core' ),
							'value'      => array_flip( biagiotti_mikado_get_link_target_array() ),
							'dependency' => array( 'element' => 'link', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'layout',
							'heading'     => esc_html__( 'Layout', 'biagiotti-core' ),
							'value'       => array(
								esc_html__( 'Default', 'biagiotti-core' )    => '',
								esc_html__( 'Predefined 1', 'biagiotti-core' ) => 'predefined1',
								esc_html__( 'Predefined 2', 'biagiotti-core' ) => 'predefined2'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Additional Features', 'biagiotti-core' )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'             => '',
			'image'                    => '',
			'overlay_color'            => '',
			'hover_behavior'           => 'mkdf-visible-on-default',
			'info_position'            => 'default',
			'info_content_padding'     => '',
			'info_border_display'      => 'yes',
			'info_border_color'        => '',
			'custom_title'             => '',
			'custom_title_padding'     => '',
			'custom_title_tag'         => 'p',
			'custom_title_font_size'   => '',
			'custom_title_line_height' => '',
			'custom_title_color'       => '',
			'title'                    => '',
			'title_tag'                => 'h3',
			'title_light_words'        => '',
			'title_color'              => '',
			'title_top_margin'         => '',
			'subtitle'                 => '',
			'subtitle_tag'             => 'h5',
			'subtitle_color'           => '',
			'link'                     => '',
			'target'                   => '_self',
			'layout'                   => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']      = $this->getHolderClasses( $params, $args );
		$params['overlay_styles']      = $this->getOverlayStyles( $params );
		$params['custom_title_tag']    = ! empty( $params['custom_title_tag'] ) ? $params['custom_title_tag'] : $args['custom_title_tag'];
		$params['custom_title_styles'] = $this->getCustomTleStyles( $params );
		$params['title']               = $this->getModifiedTitle( $params );
		$params['title_tag']           = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']        = $this->getTitleStyles( $params );
		$params['subtitle_tag']        = ! empty( $params['subtitle_tag'] ) ? $params['subtitle_tag'] : $args['subtitle_tag'];
		$params['subtitle_styles']     = $this->getSubitleStyles( $params );
		$params['info_border_display'] = ! empty( $params['info_border_display'] ) ? $params['info_border_display'] : $args['info_border_display'];
		
		$html = biagiotti_core_get_shortcode_module_template_part( 'templates/banner', 'banner', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['hover_behavior'] ) ? $params['hover_behavior'] : $args['hover_behavior'];
		$holderClasses[] = ! empty( $params['info_position'] ) ? 'mkdf-banner-info-' . $params['info_position'] : 'mkdf-banner-info-' . $args['info_position'];
		$holderClasses[] = ! empty( $params['layout'] ) ? 'mkdf-banner-' . $params['layout'] . '-layout' : '';

		return implode( ' ', $holderClasses );
	}
	
	private function getOverlayStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['overlay_color'] ) ) {
			$styles[] = 'background-color: ' . $params['overlay_color'];
		}
		
		if ( ! empty( $params['info_content_padding'] ) ) {
			$styles[] = 'padding: ' . $params['info_content_padding'];
		}
		
		if ( $params['info_border_display'] === 'yes' ) {
			if ( ! empty( $params['info_border_color'] ) ) {
				$styles[] = 'border-color: ' . $params['info_border_color'];
			}
		} else {
			$styles[] = 'border: 0';
		}
		
		return implode( ';', $styles );
	}
	
	private function getCustomTleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['custom_title_padding'] ) ) {
			$styles[] = 'padding: ' . $params['custom_title_padding'];
		}

		if ( ! empty( $params['custom_title_font_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['custom_title_font_size'] ) . 'px';
		}

		if ( ! empty( $params['custom_title_line_height'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['custom_title_line_height'] ) . 'px';
		}

		if ( ! empty( $params['custom_title_color'] ) ) {
			$styles[] = 'color: ' . $params['custom_title_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getSubitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_light_words = str_replace( ' ', '', $params['title_light_words'] );
		
		if ( ! empty( $title ) ) {
			$light_words = explode( ',', $title_light_words );
			$split_title = explode( ' ', $title );
			
			if ( ! empty( $title_light_words ) ) {
				foreach ( $light_words as $value ) {
					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="mkdf-banner-title-light">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}
			
			$title = implode( ' ', $split_title );
		}
		
		return $title;
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( ! empty( $params['title_top_margin'] ) ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}