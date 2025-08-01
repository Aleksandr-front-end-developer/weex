<?php
namespace BiagiottiCore\CPT\Shortcodes\ElementsHolder;

use BiagiottiCore\Lib;

class ElementsHolderItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_elements_holder_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Elements Holder Item', 'biagiotti-core' ),
					'base'                    => $this->base,
					'as_child'                => array( 'only' => 'mkdf_elements_holder' ),
					'as_parent'               => array( 'except' => 'vc_row, vc_accordion' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by BIAGIOTTI', 'biagiotti-core' ),
					'icon'                    => 'icon-wpb-elements-holder-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'biagiotti-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'biagiotti-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__( 'Background Image', 'biagiotti-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding',
							'heading'     => esc_html__( 'Padding', 'biagiotti-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'biagiotti-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'horizontal_alignment',
							'heading'    => esc_html__( 'Horizontal Alignment', 'biagiotti-core' ),
							'value'      => array(
								esc_html__( 'Left', 'biagiotti-core' )   => 'left',
								esc_html__( 'Right', 'biagiotti-core' )  => 'right',
								esc_html__( 'Center', 'biagiotti-core' ) => 'center'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'vertical_alignment',
							'heading'    => esc_html__( 'Vertical Alignment', 'biagiotti-core' ),
							'value'      => array(
								esc_html__( 'Middle', 'biagiotti-core' ) => 'middle',
								esc_html__( 'Top', 'biagiotti-core' )    => 'top',
								esc_html__( 'Bottom', 'biagiotti-core' ) => 'bottom'
							)
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
							'param_name'  => 'background-image-animation',
							'heading'     => esc_html__( 'Background Image Animation', 'biagiotti-core' ),
							'value'       => array(
								esc_html__( 'No', 'biagiotti-core' )  => '',
								esc_html__( 'Yes', 'biagiotti-core' ) => 'yes',
							),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'animation',
							'heading'    => esc_html__( 'Animation Type', 'biagiotti-core' ),
							'value'      => array(
								esc_html__( 'Default (No Animation)', 'biagiotti-core' )   => '',
								esc_html__( 'Element Grow In', 'biagiotti-core' )          => 'mkdf-grow-in',
								esc_html__( 'Element Fade In Down', 'biagiotti-core' )     => 'mkdf-fade-in-down',
								esc_html__( 'Element From Fade', 'biagiotti-core' )        => 'mkdf-element-from-fade',
								esc_html__( 'Element From Left', 'biagiotti-core' )        => 'mkdf-element-from-left',
								esc_html__( 'Element From Right', 'biagiotti-core' )       => 'mkdf-element-from-right',
								esc_html__( 'Element From Top', 'biagiotti-core' )         => 'mkdf-element-from-top',
								esc_html__( 'Element From Bottom', 'biagiotti-core' )      => 'mkdf-element-from-bottom',
								esc_html__( 'Element Flip In', 'biagiotti-core' )          => 'mkdf-flip-in',
								esc_html__( 'Element X Rotate', 'biagiotti-core' )         => 'mkdf-x-rotate',
								esc_html__( 'Element Z Rotate', 'biagiotti-core' )         => 'mkdf-z-rotate',
								esc_html__( 'Element Y Translate', 'biagiotti-core' )      => 'mkdf-y-translate',
								esc_html__( 'Element Fade In X Rotate', 'biagiotti-core' ) => 'mkdf-fade-in-left-x-rotate',
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__( 'Animation Delay (ms)', 'biagiotti-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1400_1600',
							'heading'     => esc_html__( 'Padding on screen size between 1400px-1600px', 'masterds-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left. For example 10px 0 10px 0', 'masterds-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'masterds-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1025_1399',
							'heading'     => esc_html__( 'Padding on screen size between 1025px-1399px', 'masterds-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left. For example 10px 0 10px 0', 'masterds-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'masterds-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_769_1024',
							'heading'     => esc_html__( 'Padding on screen size between 768px-1024px', 'biagiotti-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'biagiotti-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'biagiotti-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_681_768',
							'heading'     => esc_html__( 'Padding on screen size between 680px-768px', 'biagiotti-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'biagiotti-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'biagiotti-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_680',
							'heading'     => esc_html__( 'Padding on screen size bellow 680px', 'biagiotti-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'biagiotti-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'biagiotti-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'               => '',
			'background_color'           => '',
			'background_image'           => '',
			'item_padding'               => '',
			'horizontal_alignment'       => '',
			'vertical_alignment'         => '',
			'link'                       => '',
			'target'                     => '_self',
			'background-image-animation' => '',
			'animation'                  => '',
			'animation_delay'            => '',
			'item_padding_1400_1600'     => '',
			'item_padding_1025_1399'     => '',
			'item_padding_769_1024'      => '',
			'item_padding_681_768'       => '',
			'item_padding_680'           => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']           = $content;
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_rand_class'] = 'mkdf-eh-custom-' . mt_rand( 1000, 10000 );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['content_styles']    = $this->getContentStyles( $params );
		$params['holder_data']       = $this->getHolderData( $params );
		
		$html = biagiotti_core_get_shortcode_module_template_part( 'templates/elements-holder-item-template', 'elements-holder', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['vertical_alignment'] ) ? 'mkdf-vertical-alignment-' . $params['vertical_alignment'] : '';
		$holderClasses[] = ! empty( $params['horizontal_alignment'] ) ? 'mkdf-horizontal-alignment-' . $params['horizontal_alignment'] : '';
		$holderClasses[] = ! empty( $params['animation'] ) ? $params['animation'] : '';
		$holderClasses[] = ! empty($params['background-image-animation']) ? 'mkdf-background-image-animation' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['background_image'] ) ) {
			$styles[] = 'background-image: url(' . wp_get_attachment_url( $params['background_image'] ) . ')';
		}
		
		return implode( ';', $styles );
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['item_padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['item_padding'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_rand_class'];
		
		if ( ! empty( $params['animation'] ) ) {
			$data['data-animation'] = $params['animation'];
		}
		
		if ( $params['animation_delay'] !== '' ) {
			$data['data-animation-delay'] = esc_attr( $params['animation_delay'] );
		}
		
		if ( $params['item_padding_1400_1600'] !== '' ) {
			$data['data-1400-1600'] = $params['item_padding_1400_1600'];
		}
		
		if ( $params['item_padding_1025_1399'] !== '' ) {
			$data['data-1025-1399'] = $params['item_padding_1025_1399'];
		}
		
		if ( $params['item_padding_769_1024'] !== '' ) {
			$data['data-769-1024'] = $params['item_padding_769_1024'];
		}
		
		if ( $params['item_padding_681_768'] !== '' ) {
			$data['data-681-768'] = $params['item_padding_681_768'];
		}
		
		if ( $params['item_padding_680'] !== '' ) {
			$data['data-680'] = $params['item_padding_680'];
		}
		
		return $data;
	}
}
