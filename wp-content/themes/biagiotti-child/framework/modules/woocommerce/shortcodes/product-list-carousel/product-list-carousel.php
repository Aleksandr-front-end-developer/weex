<?php

namespace BiagiottiCore\CPT\Shortcodes\ProductListCarousel;

use BiagiottiCore\Lib;

class ProductListCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_product_list_carousel';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Product List - Carousel', 'biagiotti' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-list-carousel extended-custom-icon',
					'category'                  => esc_html__( 'by BIAGIOTTI', 'biagiotti' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'info_position',
							'heading'     => esc_html__( 'Product Info Position', 'biagiotti' ),
							'value'       => array(
								esc_html__( 'Info On Image Hover', 'biagiotti' ) => 'info-on-image',
								esc_html__( 'Info Below Image', 'biagiotti' )    => 'info-below-image'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_posts',
							'heading'    => esc_html__( 'Number of Products', 'biagiotti' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'biagiotti' ),
							'value'       => array_flip( biagiotti_mikado_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'biagiotti' ),
							'value'       => array_flip( biagiotti_mikado_get_query_order_by_array( false, array( 'on-sale' => esc_html__( 'On Sale', 'biagiotti' ) ) ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'biagiotti' ),
							'value'       => array_flip( biagiotti_mikado_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'taxonomy_to_display',
							'heading'     => esc_html__( 'Choose Sorting Taxonomy', 'biagiotti' ),
							'value'       => array(
								esc_html__( 'Category', 'biagiotti' ) => 'category',
								esc_html__( 'Tag', 'biagiotti' )      => 'tag',
								esc_html__( 'Id', 'biagiotti' )       => 'id'
							),
							'save_always' => true,
							'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'biagiotti' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'taxonomy_values',
							'heading'     => esc_html__( 'Enter Taxonomy Values', 'biagiotti' ),
							'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'biagiotti' )
						),
						array(
							'type'        => 'dropdown',
							'heading'     => esc_html__( 'Image Proportions', 'biagiotti' ),
							'param_name'  => 'image_size',
							'value'       => array(
								esc_html__( 'Default', 'biagiotti' )        => '',
								esc_html__( 'Original', 'biagiotti' )       => 'full',
								esc_html__( 'Square', 'biagiotti' )         => 'square',
								esc_html__( 'Landscape', 'biagiotti' )      => 'landscape',
								esc_html__( 'Portrait', 'biagiotti' )       => 'portrait',
								esc_html__( 'Medium', 'biagiotti' )         => 'medium',
								esc_html__( 'Large', 'biagiotti' )          => 'large',
								esc_html__( 'Shop Single', 'biagiotti' )    => 'woocommerce_single',
								esc_html__( 'Shop Thumbnail', 'biagiotti' ) => 'woocommerce_thumbnail'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_visible_items',
							'heading'     => esc_html__( 'Number Of Visible Items', 'biagiotti' ),
							'value'       => array(
								esc_html__( 'One', 'biagiotti' )   => '1',
								esc_html__( 'Two', 'biagiotti' )   => '2',
								esc_html__( 'Three', 'biagiotti' ) => '3',
								esc_html__( 'Four', 'biagiotti' )  => '4',
								esc_html__( 'Five', 'biagiotti' )  => '5',
								esc_html__( 'Six', 'biagiotti' )   => '6'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'biagiotti' ),
							'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'biagiotti' ),
							'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'biagiotti' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'biagiotti' ),
							'group'       => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'biagiotti' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'biagiotti' ),
							'group'       => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'biagiotti' ),
							'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_navigation_skin',
							'heading'    => esc_html__( 'Slider Navigation Skin', 'biagiotti' ),
							'value'      => array(
								esc_html__( 'Default', 'biagiotti' ) => 'default',
								esc_html__( 'Light', 'biagiotti' )   => 'light'
							),
							'dependency' => array( 'element' => 'slider_navigation', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_navigation_pos',
							'heading'    => esc_html__( 'Slider Navigation Position', 'biagiotti' ),
							'value'      => array(
								esc_html__( 'Inside Carousel', 'biagiotti' )  => '',
								esc_html__( 'Outside Carousel', 'biagiotti' ) => 'outside-slider'
							),
							'dependency' => array( 'element' => 'slider_navigation', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_navigation_pos_arrow',
							'heading'    => esc_html__( 'Slider Navigation Arrow Position', 'biagiotti' ),
							'value'      => array(
								esc_html__( 'Default Position', 'biagiotti' )          => '',
								esc_html__( 'Predefined Arrow Position', 'biagiotti' ) => 'predefined-arrow'
							),
							'dependency' => array( 'element' => 'slider_navigation', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'biagiotti' ),
							'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_pagination_skin',
							'heading'    => esc_html__( 'Slider Pagination Skin', 'biagiotti' ),
							'value'      => array(
								esc_html__( 'Default', 'biagiotti' ) => 'default',
								esc_html__( 'Light', 'biagiotti' )   => 'light'
							),
							'dependency' => array( 'element' => 'slider_pagination', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'slider_pagination_pos',
							'heading'    => esc_html__( 'Slider Pagination Position', 'biagiotti' ),
							'value'      => array(
								esc_html__( 'Below Carousel', 'biagiotti' )  => '',
								esc_html__( 'Inside Carousel', 'biagiotti' ) => 'inside-slider'
							),
							'dependency' => array( 'element' => 'slider_pagination', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Slider Settings', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_title',
							'heading'    => esc_html__( 'Display Title', 'biagiotti' ),
							'value'      => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'product_info_skin',
							'heading'    => esc_html__( 'Product Info Skin', 'biagiotti' ),
							'value'      => array(
								esc_html__( 'Default', 'biagiotti' ) => 'default',
								esc_html__( 'Light', 'biagiotti' )   => 'light'
							),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-on-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'biagiotti' ),
							'value'      => array_flip( biagiotti_mikado_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'biagiotti' ),
							'value'      => array_flip( biagiotti_mikado_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_category',
							'heading'    => esc_html__( 'Display Category', 'biagiotti' ),
							'value'      => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_price',
							'heading'    => esc_html__( 'Display Price', 'biagiotti' ),
							'value'      => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_rating',
							'heading'    => esc_html__( 'Display Rating', 'biagiotti' ),
							'value'      => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_excerpt',
							'heading'    => esc_html__( 'Display Excerpt', 'biagiotti' ),
							'value'      => array_flip( biagiotti_mikado_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Product Info', 'biagiotti' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'biagiotti' ),
							'description' => esc_html__( 'Number of characters', 'biagiotti' ),
							'dependency'  => array( 'element' => 'display_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Product Info Style', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_skin',
							'heading'    => esc_html__( 'Button Skin', 'biagiotti' ),
							'value'      => array(
								esc_html__( 'Default', 'biagiotti' ) => 'default',
								esc_html__( 'Light', 'biagiotti' )   => 'light'
							),
							'group'      => esc_html__( 'Product Info Style', 'biagiotti' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'shader_background_color',
							'heading'    => esc_html__( 'Shader Background Color', 'biagiotti' ),
							'group'      => esc_html__( 'Product Info Style', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'info_bottom_text_align',
							'heading'    => esc_html__( 'Product Info Text Alignment', 'biagiotti' ),
							'value'      => array(
								esc_html__( 'Default', 'biagiotti' ) => '',
								esc_html__( 'Left', 'biagiotti' )    => 'left',
								esc_html__( 'Center', 'biagiotti' )  => 'center',
								esc_html__( 'Right', 'biagiotti' )   => 'right'
							),
							'dependency' => array( 'element' => 'info_position', 'value'   => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'biagiotti' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'info_top_margin',
							'heading'    => esc_html__( 'Product Info Top Margin (px)', 'biagiotti' ),
							'dependency' => array( 'element' => 'info_position', 'value'   => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'biagiotti' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'info_bottom_margin',
							'heading'    => esc_html__( 'Product Info Bottom Margin (px)', 'biagiotti' ),
							'dependency' => array( 'element' => 'info_position', 'value'   => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'biagiotti' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'info_position'               => 'info-on-image',
			'number_of_posts'             => '8',
			'space_between_items'         => 'normal',
			'orderby'                     => 'date',
			'order'                       => 'ASC',
			'taxonomy_to_display'         => 'category',
			'taxonomy_values'             => '',
			'image_size'                  => 'full',
			'number_of_visible_items'     => '1',
			'slider_loop'                 => 'yes',
			'slider_autoplay'             => 'yes',
			'slider_speed'                => '5000',
			'slider_speed_animation'      => '600',
			'slider_navigation'           => 'yes',
			'slider_navigation_skin'      => 'default',
			'slider_navigation_pos'       => '',
			'slider_navigation_pos_arrow' => '',
			'slider_pagination'           => 'yes',
			'slider_pagination_skin'      => 'default',
			'slider_pagination_pos'       => '',
			'display_title'               => 'yes',
			'product_info_skin'           => '',
			'title_tag'                   => 'h4',
			'title_transform'             => '',
			'display_category'            => 'yes',
			'display_price'               => 'yes',
			'display_rating'              => 'yes',
			'display_excerpt'             => 'no',
			'excerpt_length'              => '20',
			'button_skin'                 => 'default',
			'shader_background_color'     => '',
			'info_bottom_text_align'      => '',
			'info_top_margin'             => '',
			'info_bottom_margin'          => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['class_name']    = 'plc';
		$params['info_position'] = ! empty( $params['info_position'] ) ? $params['info_position'] : $default_atts['info_position'];
		$params['title_tag']     = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		
		$additional_params                   = array();
		$additional_params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$additional_params['holder_data']    = $this->getProductListCarouselDataAttributes( $params );
		
		$queryArray                        = $this->generateProductQueryArray( $params );
		$query_result                      = new \WP_Query( $queryArray );
		$additional_params['query_result'] = $query_result;
		
		$params['this_object'] = $this;
		
		$html = biagiotti_mikado_get_woo_shortcode_module_template_part( 'templates/carousel', 'product-list-carousel', $params['info_position'], $params, $additional_params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['info_position'] ) ? 'mkdf-' . $params['info_position'] : 'mkdf-' . $default_atts['info_position'];
		$holderClasses[] = ! empty( $params['product_info_skin'] ) ? 'mkdf-product-info-' . $params['product_info_skin'] : '';
		$holderClasses[] = $this->getCarouselClasses( $params, $default_atts );
		
		if ( ! empty( $params['button_skin'] ) ) {
			$holderClasses[] = 'mkdf-' . $params['button_skin'] . '-skin';
		}
		
		return implode( ' ', $holderClasses );
	}
	
	private function getCarouselClasses( $params ) {
		$carouselClasses   = array();
		$carouselClasses[] = ! empty( $params['slider_navigation_skin'] ) ? 'mkdf-nav-' . $params['slider_navigation_skin'] . '-skin' : '';
		$carouselClasses[] = ! empty( $params['slider_navigation_pos'] ) ? 'mkdf-nav-' . $params['slider_navigation_pos'] : '';
		$carouselClasses[] = ! empty( $params['slider_navigation_pos_arrow'] ) ? 'mkdf-nav-' . $params['slider_navigation_pos_arrow'] : '';
		$carouselClasses[] = ! empty( $params['slider_pagination_pos'] ) ? 'mkdf-pag-' . $params['slider_pagination_pos'] : '';
		$carouselClasses[] = ! empty( $params['slider_pagination_skin'] ) ? 'mkdf-pag-' . $params['slider_pagination_skin'] . '-skin' : '';
		
		return implode( ' ', $carouselClasses );
	}
	
	private function getProductListCarouselDataAttributes( $params ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = ! empty( $params['number_of_visible_items'] ) ? $params['number_of_visible_items'] : '1';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

		$slider_data['data-nav-size']               = 'big';
		
		return $slider_data;
	}
	
	public function generateProductQueryArray( $params ) {
		$queryArray = array(
			'post_status'         => 'publish',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $params['number_of_posts'],
			'orderby'             => $params['orderby'],
			'order'               => $params['order']
		);
		
		if ( $params['orderby'] === 'on-sale' ) {
			$queryArray['no_found_rows'] = 1;
			$queryArray['post__in']      = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' ) {
			$queryArray['product_cat'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' ) {
			$queryArray['product_tag'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' ) {
			$idArray                = $params['taxonomy_values'];
			$ids                    = explode( ',', $idArray );
			$queryArray['orderby']  = 'post__in';
			$queryArray['post__in'] = $ids;
		}
		
		return $queryArray;
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getShaderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['shader_background_color'] ) ) {
			$styles[] = 'background-image: none';
			$styles[] = 'background-color: ' . $params['shader_background_color'];
		}
		
		return implode( ';', $styles );
	}

	public function getTextWrapperStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['info_bottom_text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['info_bottom_text_align'];
		}

		if ( $params['info_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['info_top_margin'] ) . 'px';
		}

		if ( $params['info_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . biagiotti_mikado_filter_px( $params['info_bottom_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}