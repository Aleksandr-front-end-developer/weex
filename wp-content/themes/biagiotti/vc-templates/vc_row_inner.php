<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$el_class = $equal_height = $content_placement = $css = $el_id = '';
$disable_element = '';
$output = $after_output = '';

/***** Our code modification - begin *****/

$row_content_width = $content_text_aligment = $simple_background_color = $simple_background_image = $background_image_position = $disable_background_image = '';
$mkdf_row_wrapper_start = $mkdf_row_wrapper_end = '';

/***** Our code modification - end *****/

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_row-has-fill';
}

if (!empty($atts['gap'])) {
	$css_classes[] = 'vc_column-gap-'.$atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $atts['rtl_reverse'] ) ) {
	$css_classes[] = 'vc_rtl-columns-reverse';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

/***** Our code modification - begin *****/

$grid_row_class = $grid_row_data = $mkdf_vc_row_style = $mkdf_grid_row_style = array();

if ( $row_content_width !== 'grid' ) {
	if ( ! empty( $disable_background_image ) ) {
		$css_classes[] = 'mkdf-disabled-bg-image-bellow-' . esc_attr( $disable_background_image );
	}
	
	if ( ! empty( $simple_background_color ) ) {
		$mkdf_vc_row_style[] = 'background-color:' . esc_attr( $simple_background_color );
	}
	
	if ( ! empty( $simple_background_image ) ) {
		$image_src            = wp_get_attachment_image_src( $simple_background_image, 'full' );
		$mkdf_vc_row_style[] = 'background-image: url(' . esc_url( $image_src[0] ) . ')';
	}

	if ( ! empty( $simple_background_image_repeat ) ) {
		$mkdf_vc_row_style[] = 'background-repeat: ' . esc_attr( $simple_background_image_repeat );
	}
	
	if ( ! empty( $background_image_position ) ) {
		$mkdf_vc_row_style[] = 'background-position: ' . esc_attr( $background_image_position );
	}
	
	if ( ! empty( $content_text_aligment ) ) {
		$css_classes[] = 'mkdf-content-aligment-' . esc_attr( $content_text_aligment );
	}
	
} else {
	if ( ! empty( $disable_background_image ) ) {
		$grid_row_class[] = 'mkdf-disabled-bg-image-bellow-' . esc_attr( $disable_background_image );
	}
	
	if ( ! empty( $simple_background_color ) ) {
		$mkdf_grid_row_style[] = 'background-color:' . esc_attr( $simple_background_color );
	}
	
	if ( ! empty( $simple_background_image ) ) {
		$image_src              = wp_get_attachment_image_src( $simple_background_image, 'full' );
		$mkdf_grid_row_style[] = 'background-image: url(' . esc_url( $image_src[0] ) . ')';
	}

	if ( ! empty( $simple_background_image_repeat ) ) {
		$mkdf_grid_row_style[] = 'background-repeat: ' . esc_attr( $simple_background_image_repeat );
	}
	
	if ( ! empty( $background_image_position ) ) {
		$mkdf_grid_row_style[] = 'background-position: ' . esc_attr( $background_image_position );
	}
	
	if ( ! empty( $content_text_aligment ) ) {
		$grid_row_class[] = 'mkdf-content-aligment-' . esc_attr( $content_text_aligment );
	}
}

$grid_row_classes = '';
if ( ! empty( $grid_row_class ) ) {
	$grid_row_classes = implode( ' ', $grid_row_class );
}

$mkdf_vc_row_styles = '';
if ( ! empty( $mkdf_vc_row_style ) ) {
	$mkdf_vc_row_styles = implode( ';', $mkdf_vc_row_style );
}

$mkdf_grid_row_styles = '';
if ( ! empty( $mkdf_grid_row_style ) ) {
	$mkdf_grid_row_styles = implode( ';', $mkdf_grid_row_style );
}

$mkdf_bg_svg_html = '';
if ( !empty($bg_svg_source) ) {
	
	if ( biagiotti_mikado_is_plugin_installed('core') ) {
		$bg_svg_source = biagiotti_mikado_decode_svg_source( $bg_svg_source );
	} else {
		$bg_svg_source = '';
	}
	
	$bg_svg_styles = array();
	
	if ( ! empty( $bg_svg_rotate ) ) {
		$bg_svg_rotate = biagiotti_mikado_filter_suffix( $bg_svg_rotate, 'deg' ) . 'deg';
		$bg_svg_styles[] = 'transform: rotate(' . esc_attr( $bg_svg_rotate ) . ')';
	}
	
	if ( ! empty( $bg_svg_top ) ) {
		if ( ! biagiotti_mikado_string_ends_with( $bg_svg_top, '%' ) && ! biagiotti_mikado_string_ends_with( $bg_svg_top, 'px' ) ) {
			$bg_svg_top = biagiotti_mikado_filter_px( $bg_svg_top ) . 'px';
		}
		$bg_svg_styles[] = 'top: ' . esc_attr( $bg_svg_top );
	}
	
	if ( ! empty( $bg_svg_left ) ) {
		if ( ! biagiotti_mikado_string_ends_with( $bg_svg_left, '%' ) && ! biagiotti_mikado_string_ends_with( $bg_svg_left, 'px' ) ) {
			$bg_svg_left = biagiotti_mikado_filter_px( $bg_svg_left ) . 'px';
		}
		$bg_svg_styles[] = 'left: ' . esc_attr( $bg_svg_left );
	}
	
	//generate background text html
	$mkdf_bg_svg_html = '<div class="mkdf-row-bg-svg-holder">';
	$mkdf_bg_svg_html .= '<span class="mkdf-row-bg-svg" ' . biagiotti_mikado_get_inline_style( $bg_svg_styles ) . '>'.biagiotti_mikado_get_module_part($bg_svg_source).'</span>';
	$mkdf_bg_svg_html .= '</div>';
}

$mkdf_bg_text_html = '';
if ( !empty($bg_text) ) {
	$bg_text_holder_styles = array();
	$bg_text_styles        = array();
	
	if ( ! empty( $bg_text_bottom ) ) {
		if ( ! biagiotti_mikado_string_ends_with( $bg_text_bottom, '%' ) && ! biagiotti_mikado_string_ends_with( $bg_text_bottom, 'px' ) ) {
			$bg_text_bottom = biagiotti_mikado_filter_px( $bg_text_bottom ) . 'px';
		}
		$bg_text_holder_styles[] = 'bottom: ' . esc_attr( $bg_text_bottom );
	}
	
	if ( ! empty( $bg_text_right ) ) {
		if ( ! biagiotti_mikado_string_ends_with( $bg_text_right, '%' ) && ! biagiotti_mikado_string_ends_with( $bg_text_right, 'px' ) ) {
			$bg_text_right = biagiotti_mikado_filter_px( $bg_text_right ) . 'px';
		}
		$bg_text_holder_styles[] = 'right: ' . esc_attr( $bg_text_right );
	}
	
	if ( ! empty( $bg_text_font_size ) ) {
		$bg_text_font_size = biagiotti_mikado_filter_suffix( $bg_text_font_size, 'px' ) . 'px';
		$bg_text_styles[]  = 'font-size: ' . esc_attr( $bg_text_font_size );
	}
	
	if ( ! empty( $bg_text_color ) ) {
		$bg_text_styles[] = 'color: ' . esc_attr( $bg_text_color );
	}
	
	if ( ! empty( $bg_text_transparency ) ) {
		$bg_text_styles[] = 'opacity: ' . esc_attr( $bg_text_transparency );
	}
	
	//generate background text html
	$mkdf_bg_text_html = '<div class="mkdf-row-bg-text-holder '.esc_attr( $bg_text_appear ).' '.esc_attr( $bg_text_placement ).'" ' . biagiotti_mikado_get_inline_style( $bg_text_holder_styles ) . '>';
	$mkdf_bg_text_html .= '<div class="mkdf-row-bg-text-inner">';
	$mkdf_bg_text_html .= '<span class="mkdf-row-bg-text" ' . biagiotti_mikado_get_inline_style( $bg_text_styles ) . '>'.esc_attr($bg_text).'</span>';
	$mkdf_bg_text_html .= '</div>';
	$mkdf_bg_text_html .= '</div>';
}

if ( $row_content_width === 'grid' ) {
	$mkdf_row_wrapper_start .= '<div class="mkdf-row-grid-section-wrapper ' . esc_attr( $grid_row_classes ) . '" ' . biagiotti_mikado_get_inline_style( $mkdf_grid_row_styles ) . '><div class="mkdf-row-grid-section">';
	$mkdf_row_wrapper_end   .= '</div></div>';
}

/***** Our code modification - end *****/

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= $mkdf_row_wrapper_start;
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' ' . biagiotti_mikado_get_inline_style( $mkdf_vc_row_styles ) . '>';
$output .= $mkdf_bg_svg_html;
$output .= $mkdf_bg_text_html;
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $mkdf_row_wrapper_end;
$output .= $after_output;

echo biagiotti_mikado_get_module_part( $output );
