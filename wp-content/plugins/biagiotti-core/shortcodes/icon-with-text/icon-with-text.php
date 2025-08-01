<?php

namespace BiagiottiCore\CPT\Shortcodes\IconWithText;

use BiagiottiCore\Lib;

class IconWithText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_icon_with_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Icon With Text', 'biagiotti-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-icon-with-text extended-custom-icon',
					'category'                  => esc_html__( 'by BIAGIOTTI', 'biagiotti-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'textfield',
								'param_name'  => 'custom_class',
								'heading'     => esc_html__( 'Custom CSS Class', 'biagiotti-core' ),
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'biagiotti-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'type',
								'heading'     => esc_html__( 'Type', 'biagiotti-core' ),
								'value'       => array(
									esc_html__( 'Icon Left From Text', 'biagiotti-core' )  => 'icon-left',
									esc_html__( 'Icon Left From Title', 'biagiotti-core' ) => 'icon-left-from-title',
									esc_html__( 'Icon Top', 'biagiotti-core' )             => 'icon-top'
								),
								'save_always' => true
							)
						),
						biagiotti_mikado_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_icon',
								'heading'    => esc_html__( 'Custom Icon', 'biagiotti-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_type',
								'heading'    => esc_html__( 'Icon Type', 'biagiotti-core' ),
								'value'      => array(
									esc_html__( 'Normal', 'biagiotti-core' ) => 'mkdf-normal',
									esc_html__( 'Circle', 'biagiotti-core' ) => 'mkdf-circle',
									esc_html__( 'Square', 'biagiotti-core' ) => 'mkdf-square'
								),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_size',
								'heading'    => esc_html__( 'Icon Size', 'biagiotti-core' ),
								'value'      => array(
									esc_html__( 'Medium', 'biagiotti-core' )     => 'mkdf-icon-medium',
									esc_html__( 'Tiny', 'biagiotti-core' )       => 'mkdf-icon-tiny',
									esc_html__( 'Small', 'biagiotti-core' )      => 'mkdf-icon-small',
									esc_html__( 'Large', 'biagiotti-core' )      => 'mkdf-icon-large',
									esc_html__( 'Very Large', 'biagiotti-core' ) => 'mkdf-icon-huge'
								),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'custom_icon_size',
								'heading'    => esc_html__( 'Custom Icon Size (px)', 'biagiotti-core' ),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'shape_size',
								'heading'    => esc_html__( 'Shape Size (px)', 'biagiotti-core' ),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_color',
								'heading'    => esc_html__( 'Icon Color', 'biagiotti-core' ),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_color',
								'heading'    => esc_html__( 'Icon Hover Color', 'biagiotti-core' ),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_background_color',
								'heading'    => esc_html__( 'Icon Background Color', 'biagiotti-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_background_color',
								'heading'    => esc_html__( 'Icon Hover Background Color', 'biagiotti-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_color',
								'heading'    => esc_html__( 'Icon Border Color', 'biagiotti-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_hover_color',
								'heading'    => esc_html__( 'Icon Border Hover Color', 'biagiotti-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_border_width',
								'heading'    => esc_html__( 'Border Width (px)', 'biagiotti-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_animation',
								'heading'    => esc_html__( 'Icon Animation', 'biagiotti-core' ),
								'value'      => array_flip( biagiotti_mikado_get_yes_no_select_array( false ) ),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_animation_delay',
								'heading'    => esc_html__( 'Icon Animation Delay (ms)', 'biagiotti-core' ),
								'dependency' => array( 'element' => 'icon_animation', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Icon Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'attach_image',
								'param_name' => 'background_icon',
								'dependency' => array( 'element' => 'type', 'value' => array( 'icon-top' ) ),
								'heading'    => esc_html__( 'Background Icon', 'biagiotti-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'bg_scale_size',
								'heading'     => esc_html__( 'Scale Size', 'biagiotti-core' ),
								'dependency'  => array( 'element' => 'background_icon', 'not_empty' => true ),
								'group'       => esc_html__( 'Background Icon Settings', 'biagiotti-core' ),
								'description' => esc_html__( 'Set scale size (example: 1.2 )', 'biagiotti-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'bg_margin',
								'heading'    => esc_html__( 'Background Margin (px)', 'biagiotti-core' ),
								'dependency' => array( 'element' => 'background_icon', 'not_empty' => true ),
								'group'      => esc_html__( 'Background Icon Settings', 'biagiotti-core' )
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
								'value'       => array_flip( biagiotti_mikado_get_title_tag( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
								'group'       => esc_html__( 'Text Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'title_color',
								'heading'    => esc_html__( 'Title Color', 'biagiotti-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title_top_margin',
								'heading'    => esc_html__( 'Title Top Margin (px)', 'biagiotti-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'textarea',
								'param_name' => 'text',
								'heading'    => esc_html__( 'Text', 'biagiotti-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'text_color',
								'heading'    => esc_html__( 'Text Color', 'biagiotti-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'biagiotti-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'text_top_margin',
								'heading'    => esc_html__( 'Text Top Margin (px)', 'biagiotti-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'biagiotti-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'link',
								'heading'     => esc_html__( 'Link', 'biagiotti-core' ),
								'description' => esc_html__( 'Set link around icon and title', 'biagiotti-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'target',
								'heading'    => esc_html__( 'Target', 'biagiotti-core' ),
								'value'      => array_flip( biagiotti_mikado_get_link_target_array() ),
								'dependency' => array( 'element' => 'link', 'not_empty' => true ),
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text_padding',
								'heading'     => esc_html__( 'Text Padding (px)', 'biagiotti-core' ),
								'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'biagiotti-core' ),
								'dependency'  => array(
									'element' => 'type',
									'value'   => array( 'icon-left', 'icon-top' )
								),
								'group'       => esc_html__( 'Text Settings', 'biagiotti-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_class'                => '',
			'type'                        => 'icon-left',
			'custom_icon'                 => '',
			'icon_type'                   => 'mkdf-normal',
			'icon_size'                   => 'mkdf-icon-medium',
			'custom_icon_size'            => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_hover_color'            => '',
			'icon_background_color'       => '',
			'icon_hover_background_color' => '',
			'icon_border_color'           => '',
			'icon_border_hover_color'     => '',
			'icon_border_width'           => '',
			'icon_animation'              => '',
			'icon_animation_delay'        => '',
			'background_icon'             => '',
			'bg_scale_size'               => '',
			'bg_margin'                   => '',
			'title'                       => '',
			'title_tag'                   => 'h4',
			'title_color'                 => '',
			'title_top_margin'            => '',
			'text'                        => '',
			'text_color'                  => '',
			'text_top_margin'             => '',
			'link'                        => '',
			'target'                      => '_self',
			'text_padding'                => ''
		);
		$default_atts = array_merge( $default_atts, biagiotti_mikado_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		
		$params['bg_icon_parameters'] = $this->getBgIconParameters( $params );
		$params['icon_parameters']    = $this->getIconParameters( $params );
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['content_styles']     = $this->getContentStyles( $params );
		$params['title_styles']       = $this->getTitleStyles( $params );
		$params['title_tag']          = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['text_styles']        = $this->getTextStyles( $params );
		$params['target']             = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		return biagiotti_core_get_shortcode_module_template_part( 'templates/iwt', 'icon-with-text', $params['type'], $params );
	}
	
	private function getBgIconParameters( $params ) {
		$params_array = array();
		
		if ( ! empty( $params['background_icon'] ) ) {
			
			if ( ! empty( $params['bg_scale_size'] ) ) {
				$params_array['bg_scale_size'] = 'transform: scale(' . ( $params['bg_scale_size'] ) . ')';
			}
			
			if ( $params['bg_margin'] !== '' ) {
				$params_array[] = 'margin: ' . biagiotti_mikado_filter_px( $params['bg_margin'] ) . 'px';
			}
		}
		
		return $params_array;
	}
	
	private function getIconParameters( $params ) {
		$params_array = array();
		
		if ( empty( $params['custom_icon'] ) ) {
			$iconPackName = biagiotti_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			
			$params_array['icon_pack']     = $params['icon_pack'];
			$params_array[ $iconPackName ] = $params[ $iconPackName ];
			
			if ( ! empty( $params['icon_size'] ) ) {
				$params_array['size'] = $params['icon_size'];
			}
			
			if ( ! empty( $params['custom_icon_size'] ) ) {
				$params_array['custom_size'] = biagiotti_mikado_filter_px( $params['custom_icon_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_type'] ) ) {
				$params_array['type'] = $params['icon_type'];
			}
			
			if ( ! empty( $params['shape_size'] ) ) {
				$params_array['shape_size'] = biagiotti_mikado_filter_px( $params['shape_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_border_color'] ) ) {
				$params_array['border_color'] = $params['icon_border_color'];
			}
			
			if ( ! empty( $params['icon_border_hover_color'] ) ) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}
			
			if ( $params['icon_border_width'] !== '' ) {
				$params_array['border_width'] = biagiotti_mikado_filter_px( $params['icon_border_width'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_background_color'] ) ) {
				$params_array['background_color'] = $params['icon_background_color'];
			}
			
			if ( ! empty( $params['icon_hover_background_color'] ) ) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}
			
			$params_array['icon_color'] = $params['icon_color'];
			
			if ( ! empty( $params['icon_hover_color'] ) ) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}
			
			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}
		
		return $params_array;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array( 'mkdf-iwt', 'clearfix' );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-iwt-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['icon_size'] ) ? 'mkdf-iwt-' . str_replace( 'mkdf-', '', $params['icon_size'] ) : '';
		
		return $holderClasses;
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-left' ) {
			$styles[] = 'padding-left: ' . biagiotti_mikado_filter_px( $params['text_padding'] ) . 'px';
		}
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-top' ) {
			$styles[] = 'padding-top: ' . biagiotti_mikado_filter_px( $params['text_padding'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}