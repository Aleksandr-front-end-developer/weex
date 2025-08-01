<?php

namespace BiagiottiCore\CPT\Shortcodes\ProductExhibition;

use BiagiottiCore\Lib;

class ProductExhibition implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_product_exhibition';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Product Exhibition', 'biagiotti' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-exhibition extended-custom-icon',
					'category'                  => esc_html__( 'by BIAGIOTTI', 'biagiotti' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orientation',
							'heading'     => esc_html__( 'Orientation', 'biagiotti' ),
							'value'       => array(
								esc_html__( 'Default', 'biagiotti' ) => '',
								esc_html__( 'Left', 'biagiotti' )    => 'right',
								esc_html__( 'Right', 'biagiotti' )   => 'right'
							),
							'save_always' => true
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'main_image',
							'heading'     => esc_html__( 'Main Image', 'biagiotti' ),
							'description' => esc_html__( 'Select image from media library', 'biagiotti' ),
							'group'       => esc_html__( 'Main Section', 'biagiotti' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'main_title',
							'heading'     => esc_html__( 'Main Title', 'biagiotti' ),
							'group'       => esc_html__( 'Main Section', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'main_title_tag',
							'heading'    => esc_html__( 'Main Title Tag', 'biagiotti' ),
							'value'      => array_flip( biagiotti_mikado_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'main_title', 'not_empty' => true ),
							'group'      => esc_html__( 'Main Section', 'biagiotti' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'tagline',
							'heading'     => esc_html__( 'Tagline', 'biagiotti' ),
							'group'       => esc_html__( 'Main Section', 'biagiotti' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'tagline_tag',
							'heading'     => esc_html__( 'Tagline Tag', 'biagiotti' ),
							'value'       => array_flip( biagiotti_mikado_get_title_tag( true, array(
								'div'  => esc_html__( 'Stylized', 'biagiotti' )
							) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'tagline', 'not_empty' => true ),
							'group'       => esc_html__( 'Main Section', 'biagiotti' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'tagline_margin',
							'heading'    => esc_html__( 'Tagline Bottom Margin (px)', 'biagiotti' ),
							'dependency' => array( 'element' => 'tagline', 'not_empty' => true ),
							'group'      => esc_html__( 'Main Section', 'biagiotti' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Link', 'biagiotti' ),
							'group'      => esc_html__( 'Main Section', 'biagiotti' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'target',
							'heading'    => esc_html__( 'Link Target', 'biagiotti' ),
							'value'      => array_flip( biagiotti_mikado_get_link_target_array() ),
							'dependency' => array( 'element' => 'link', 'not_empty' => true ),
							'group'      => esc_html__( 'Main Section', 'biagiotti' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_posts',
							'heading'    => esc_html__( 'Number of Products', 'biagiotti' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'biagiotti' ),
							'value'       => array_flip( biagiotti_mikado_get_number_of_columns_array( true ) ),
							'save_always' => true
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
							'type'       => 'dropdown',
							'param_name' => 'image_size',
							'heading'    => esc_html__( 'Image Proportions', 'biagiotti' ),
							'value'      => array(
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
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$default_atts = array(
			'orientation'             => '',
			'main_image'              => '',
			'main_title'              => '',
			'main_title_tag'          => 'h2',
			'tagline'                 => '',
			'tagline_tag'             => 'div',
			'tagline_margin'          => '',
			'link'                    => '',
			'target'                  => '_self',
			'number_of_posts'         => '8',
			'number_of_columns'       => 'four',
			'space_between_items'     => 'normal',
			'orderby'                 => 'date',
			'order'                   => 'ASC',
			'taxonomy_to_display'     => 'category',
			'taxonomy_values'         => '',
			'image_size'              => 'full',
			'display_title'           => 'yes',
			'product_info_skin'       => '',
			'title_tag'               => 'h4',
			'title_transform'         => '',
			'display_category'        => 'yes',
			'excerpt_length'          => '20',
			'display_price'           => 'yes',
			'display_rating'          => 'yes',
			'display_excerpt'         => 'no',
			'button_skin'             => 'default',
			'shader_background_color' => '',
		);
		$params = shortcode_atts( $default_atts, $atts );
		$params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$params['main_section_bg_styles'] = $this->getBackgroundImageStyles( $params['main_image'] );
		$params['main_title_tag'] = ! empty( $params['main_title_tag'] ) ? $params['main_title_tag'] : $default_atts['main_title_tag'];
		$params['tagline_tag'] = ! empty( $params['tagline_tag'] ) ? $params['tagline_tag'] : $default_atts['tagline_tag'];
		$params['tagline_styles'] = $this->getTaglineStyles( $params );
		$params['orientation'] = ! empty( $params['orientation'] ) ? $params['orientation'] : $default_atts['orientation'];

		$html = biagiotti_mikado_get_woo_shortcode_module_template_part( 'templates/product-exhibition', 'product-exhibition', '', $params );

		return $html;
	}

	private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();

		$holderClasses[] = ! empty( $params['orientation'] ) ? 'mkdf-' . $params['orientation'] . '-orientation' : 'mkdf-' . $default_atts['orientation'] . '-orientation';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-offset' : 'mkdf-' . $default_atts['space_between_items'] . '-offset';

		return implode( ' ', $holderClasses );
	}

	private function getBackgroundImageStyles( $image ) {
		$styles = array();

		if ( ! empty( $image ) ) {
			$image_original = wp_get_attachment_image_src( $image, 'full' );

			$styles[] = 'background-image: url(' . $image_original[0] . ')';
			$styles[] = 'background-repeat: no-repeat';
            $styles[] = 'background-size: cover';
		}

		return implode( ';', $styles );
	}

	private function getTaglineStyles( $params ) {
		$styles = array();

		if ( $params['tagline_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . biagiotti_mikado_filter_px( $params['tagline_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}