<?php

namespace BiagiottiCore\CPT\Shortcodes\SectionTitle;

use BiagiottiCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_section_title';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Section Title', 'biagiotti-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by BIAGIOTTI', 'biagiotti-core' ),
					'icon'                      => 'icon-wpb-section-title extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'biagiotti-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'position',
							'heading'     => esc_html__( 'Horizontal Position', 'biagiotti-core' ),
							'value'       => array(
								esc_html__( 'Default', 'biagiotti-core' ) => '',
								esc_html__( 'Left', 'biagiotti-core' )    => 'left',
								esc_html__( 'Center', 'biagiotti-core' )  => 'center',
								esc_html__( 'Right', 'biagiotti-core' )   => 'right'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'holder_padding',
							'heading'    => esc_html__( 'Holder Side Padding (px or %)', 'biagiotti-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'tagline',
							'heading'     => esc_html__( 'Tagline', 'biagiotti-core' ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'tagline_tag',
							'heading'     => esc_html__( 'Tagline Tag', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_title_tag( true, array(
								'p'    => 'p',
								'span' => esc_html__( 'Custom', 'biagiotti-core' )
							) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'tagline', 'not_empty' => true ),
							'group'       => esc_html__( 'Tagline Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'tagline_position',
							'heading'    => esc_html__( 'Tagline Position', 'biagiotti-core' ),
							'value'      => array(
								esc_html__( 'Top', 'biagiotti-core' )    => 'top',
								esc_html__( 'Bottom', 'biagiotti-core' ) => 'bottom'
							),
							'dependency' => array( 'element' => 'tagline', 'not_empty' => true ),
							'group'      => esc_html__( 'Tagline Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'tagline_color',
							'heading'    => esc_html__( 'Tagline Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'tagline', 'not_empty' => true ),
							'group'      => esc_html__( 'Tagline Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'tagline_font_size',
							'heading'    => esc_html__( 'Tagline Font Size (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'tagline', 'not_empty' => true ),
							'group'      => esc_html__( 'Tagline Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'tagline_line_height',
							'heading'    => esc_html__( 'Tagline Line Height (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'tagline', 'not_empty' => true ),
							'group'      => esc_html__( 'Tagline Style', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'tagline_font_weight',
							'heading'     => esc_html__( 'Tagline Font Weight', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'tagline', 'not_empty' => true ),
							'group'       => esc_html__( 'Tagline Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'tagline_margin',
							'heading'    => esc_html__( 'Tagline Bottom Margin (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'tagline', 'not_empty' => true ),
							'group'      => esc_html__( 'Tagline Style', 'biagiotti-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'biagiotti-core' ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'biagiotti-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'biagiotti-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'biagiotti-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'disable_break_words',
							'heading'     => esc_html__( 'Disable Line Break for Smaller Screens', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'biagiotti-core' )
						),
						
						array(
							'type'       => 'textarea',
							'param_name' => 'subtitle',
							'heading'    => esc_html__( 'Subtitle', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'subtitle_tag',
							'heading'     => esc_html__( 'Subtitle Tag', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'       => esc_html__( 'Subtitle Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'subtitle_color',
							'heading'    => esc_html__( 'Subtitle Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'      => esc_html__( 'Subtitle Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_font_size',
							'heading'    => esc_html__( 'Subtitle Font Size (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'      => esc_html__( 'Subtitle Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_line_height',
							'heading'    => esc_html__( 'Subtitle Line Height (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'      => esc_html__( 'Subtitle Style', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'subtitle_font_weight',
							'heading'     => esc_html__( 'Subtitle Font Weight', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'       => esc_html__( 'Subtitle Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_margin',
							'heading'    => esc_html__( 'Subtitle Top Margin (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'      => esc_html__( 'Subtitle Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_tag',
							'heading'     => esc_html__( 'Text Tag', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_font_size',
							'heading'    => esc_html__( 'Text Font Size (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_line_height',
							'heading'    => esc_html__( 'Text Line Height (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'biagiotti-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_font_weight',
							'heading'     => esc_html__( 'Text Font Weight', 'biagiotti-core' ),
							'value'       => array_flip( biagiotti_mikado_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'biagiotti-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'biagiotti-core' ),
							'description' => esc_html__( 'Select image from media library', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_text',
							'heading'    => esc_html__( 'Button Text', 'biagiotti-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_type',
							'heading'    => esc_html__( 'Button Type', 'biagiotti-core' ),
							'value'      => array(
								esc_html__( 'Solid', 'biagiotti-core' )   => 'solid',
								esc_html__( 'Outline', 'biagiotti-core' ) => 'outline',
								esc_html__( 'Simple', 'biagiotti-core' )  => 'simple'
							),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_link',
							'heading'    => esc_html__( 'Button Link', 'biagiotti-core' ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_target',
							'heading'    => esc_html__( 'Button Link Target', 'biagiotti-core' ),
							'value'      => array_flip( biagiotti_mikado_get_link_target_array() ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_color',
							'heading'    => esc_html__( 'Button Color', 'biagiotti-core' ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_color',
							'heading'    => esc_html__( 'Button Hover Color', 'biagiotti-core' ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_background_color',
							'heading'    => esc_html__( 'Button Background Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid' ) ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_background_color',
							'heading'    => esc_html__( 'Button Hover Background Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid', 'outline' ) ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_border_color',
							'heading'    => esc_html__( 'Button Border Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid', 'outline' ) ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_border_color',
							'heading'    => esc_html__( 'Button Hover Border Color', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid', 'outline' ) ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_top_margin',
							'heading'    => esc_html__( 'Button Top Margin (px)', 'biagiotti-core' ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_position',
							'heading'    => esc_html__( 'Image Position', 'biagiotti-core' ),
							'value'      => array(
								esc_html__( 'Top', 'biagiotti-core' )    => 'top',
								esc_html__( 'Bottom', 'biagiotti-core' ) => 'bottom'
							),
							'dependency' => array( 'element' => 'image', 'not_empty' => true ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'image_top_margin',
							'heading'    => esc_html__( 'Image Top Margin (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'image', 'not_empty' => true ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'image_bottom_margin',
							'heading'    => esc_html__( 'Image Bottom Margin (px)', 'biagiotti-core' ),
							'dependency' => array( 'element' => 'image', 'not_empty' => true ),
							'group'      => esc_html__( 'Additional Style', 'biagiotti-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'                  => '',
			'position'                      => 'center',
			'holder_padding'                => '',
			'tagline'                       => '',
			'tagline_tag'                   => 'span',
			'tagline_position'              => 'top',
			'tagline_color'                 => '',
			'tagline_font_size'             => '',
			'tagline_line_height'           => '',
			'tagline_font_weight'           => '',
			'tagline_margin'                => '',
			'title'                         => '',
			'title_tag'                     => 'h2',
			'title_color'                   => '',
			'title_break_words'             => '',
			'disable_break_words'           => '',
			'subtitle'                      => '',
			'subtitle_tag'                  => 'h5',
			'subtitle_color'                => '',
			'subtitle_font_size'            => '',
			'subtitle_line_height'          => '',
			'subtitle_font_weight'          => '',
			'subtitle_margin'               => '',
			'text'                          => '',
			'text_tag'                      => 'p',
			'text_color'                    => '',
			'text_font_size'                => '',
			'text_line_height'              => '',
			'text_font_weight'              => '',
			'text_margin'                   => '',
			'image'                         => '',
			'image_position'                => 'bottom',
			'image_top_margin'              => '',
			'image_bottom_margin'           => '',
			'button_text'                   => '',
			'button_type'                   => 'outline',
			'button_link'                   => '',
			'button_target'                 => '_self',
			'button_color'                  => '',
			'button_hover_color'            => '',
			'button_background_color'       => '',
			'button_hover_background_color' => '',
			'button_border_color'           => '',
			'button_hover_border_color'     => '',
			'button_top_margin'             => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['position']          = ! empty( $params['position'] ) ? $params['position'] : $args['position'];
		$params['holder_classes']    = $this->getHolderClasses( $params, $args );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['tagline_tag']       = ! empty( $params['tagline_tag'] ) ? $params['tagline_tag'] : $args['tagline_tag'];
		$params['tagline_position']  = ! empty( $params['tagline_position'] ) ? $params['tagline_position'] : $args['tagline_position'];
		$params['tagline_styles']    = $this->getTaglineStyles( $params );
		$params['title']             = $this->getModifiedTitle( $params );
		$params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']      = $this->getTitleStyles( $params );
		$params['subtitle_tag']      = ! empty( $params['subtitle_tag'] ) ? $params['subtitle_tag'] : $args['subtitle_tag'];
		$params['subtitle_styles']   = $this->getSubtitleStyles( $params );
		$params['text_tag']          = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];
		$params['text_styles']       = $this->getTextStyles( $params );
		$params['image']             = $this->getImage( $params );
		$params['image_position']    = ! empty( $params['image_position'] ) ? $params['image_position'] : $args['image_position'];
		$params['image_styles']      = $this->getImageStyles( $params );
		$params['button_type']       = ! empty( $params['button_type'] ) ? $params['button_type'] : $args['button_type'];
		$params['button_parameters'] = $this->getButtonParameters( $params );
		
		$html = biagiotti_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['tagline_position'] ) ? 'mkdf-st-' . $params['tagline_position'] . '-tagline-position' : '';
		$holderClasses[] = ! empty( $params['position'] ) ? 'mkdf-st-' . $params['position'] . '-position' : '';
		$holderClasses[] = ! empty( $params['image_position'] ) ? 'mkdf-st-' . $params['image_position'] . '-image-position' : '';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'mkdf-st-disable-title-break' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}
		
		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTaglineStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['tagline_color'] ) ) {
			$styles[] = 'color: ' . $params['tagline_color'];
		}
		
		if ( ! empty( $params['tagline_font_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['tagline_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['tagline_line_height'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['tagline_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['tagline_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['tagline_font_weight'];
		}
		
		if ( $params['tagline_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . biagiotti_mikado_filter_px( $params['tagline_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] );
		
		if ( ! empty( $title ) ) {
			$split_title = explode( ' ', $title );
			
			if ( ! empty( $title_break_words ) ) {
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
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
		
		return implode( ';', $styles );
	}
	
	private function getSubtitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}
		
		if ( ! empty( $params['subtitle_font_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['subtitle_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['subtitle_line_height'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['subtitle_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['subtitle_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['subtitle_font_weight'];
		}
		
		if ( $params['subtitle_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['subtitle_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( ! empty( $params['text_font_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['text_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['text_line_height'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['text_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['text_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['text_font_weight'];
		}
		
		if ( $params['text_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['text_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getImage( $params ) {
		$image = array();
		
		if ( ! empty( $params['image'] ) ) {
			$id = $params['image'];
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}
		
		return $image;
	}
	
	private function getImageStyles( $params ) {
		$styles = array();
		
		if ( $params['image_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['image_top_margin'] ) . 'px';
		}
		
		if ( $params['image_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . biagiotti_mikado_filter_px( $params['image_bottom_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getButtonParameters( $params ) {
		$button_params = array();
		
		if ( ! empty( $params['button_text'] ) ) {
			$button_params['text']   = $params['button_text'];
			$button_params['type']   = $params['button_type'];
			$button_params['link']   = ! empty( $params['button_link'] ) ? $params['button_link'] : '#';
			$button_params['target'] = ! empty( $params['button_target'] ) ? $params['button_target'] : '_self';
			
			if ( ! empty( $params['button_color'] ) ) {
				$button_params['color'] = $params['button_color'];
			}
			
			if ( ! empty( $params['button_hover_color'] ) ) {
				$button_params['hover_color'] = $params['button_hover_color'];
			}
			
			if ( ! empty( $params['button_background_color'] ) ) {
				$button_params['background_color'] = $params['button_background_color'];
			}
			
			if ( ! empty( $params['button_hover_background_color'] ) ) {
				$button_params['hover_background_color'] = $params['button_hover_background_color'];
			}
			
			if ( ! empty( $params['button_border_color'] ) ) {
				$button_params['border_color'] = $params['button_border_color'];
			}
			
			if ( ! empty( $params['button_hover_border_color'] ) ) {
				$button_params['hover_border_color'] = $params['button_hover_border_color'];
			}
			
			if ( $params['button_top_margin'] !== '' ) {
				$button_params['margin'] = intval( $params['button_top_margin'] ) . 'px 0 0';
			}
		}
		
		return $button_params;
	}
}