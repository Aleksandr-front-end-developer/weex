<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $css_animation = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$disable_element = '';
$output = $after_output = '';

/***** Our code modification - begin *****/

$row_content_width = $anchor = $content_text_aligment = $simple_background_color = $simple_background_image = $background_image_position = $disable_background_image = $parallax_background_image = $parallax_bg_speed = $parallax_bg_height = '';
$mkdf_row_wrapper_start = $mkdf_row_wrapper_end = '';

/***** Our code modification - end *****/

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
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

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
	$css_classes[]='vc_row-has-fill';
}

if (!empty($atts['gap'])) {
	$css_classes[] = 'vc_column-gap-'.$atts['gap'];
}

if ( ! empty( $atts['rtl_reverse'] ) ) {
	$css_classes[] = 'vc_rtl-columns-reverse';
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}

/***** Our code modification - begin *****/

if ( ! empty( $anchor ) ) {
	$wrapper_attributes[] = 'data-mkdf-anchor="' . esc_attr( $anchor ) . '"';
}

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
	
	if ( ! empty( $parallax_background_image ) ) {
		$image_src = wp_get_attachment_image_src( $parallax_background_image, 'full' );
		
		$css_classes[]        = 'mkdf-parallax-row-holder';
		$wrapper_attributes[] = 'data-parallax-bg-image="' . esc_url( $image_src[0] ) . '"';
		
		if ( $parallax_bg_speed !== '' ) {
			$wrapper_attributes[] = 'data-parallax-bg-speed="' . esc_attr( $parallax_bg_speed ) . '"';
		} else {
			$wrapper_attributes[] = 'data-parallax-bg-speed="1"';
		}
		
		if ( ! empty( $parallax_bg_height ) ) {
			$wrapper_attributes[] = 'data-parallax-bg-height="' . esc_attr( $parallax_bg_height ) . '"';
		}
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
	
	if ( ! empty( $parallax_background_image ) ) {
		$image_src = wp_get_attachment_image_src( $parallax_background_image, 'full' );
		
		$grid_row_class[] = 'mkdf-parallax-row-holder';
		$grid_row_data[]  = 'data-parallax-bg-image=' . esc_url( $image_src[0] );
		
		if ( $parallax_bg_speed !== '' ) {
			$grid_row_data[] = 'data-parallax-bg-speed=' . esc_attr( $parallax_bg_speed );
		} else {
			$grid_row_data[] = 'data-parallax-bg-speed=1';
		}
		
		if ( ! empty( $parallax_bg_height ) ) {
			$grid_row_data[] = 'data-parallax-bg-height=' . esc_attr( $parallax_bg_height );
		}
	}
	
	if ( ! empty( $content_text_aligment ) ) {
		$grid_row_class[] = 'mkdf-content-aligment-' . esc_attr( $content_text_aligment );
	}
}

$grid_row_classes = '';
if ( ! empty( $grid_row_class ) ) {
	$grid_row_classes = implode( ' ', $grid_row_class );
}

$grid_row_datas = '';
if ( ! empty( $grid_row_data ) ) {
	$grid_row_datas = implode( ' ', $grid_row_data );
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
	$mkdf_row_wrapper_start .= '<div class="mkdf-row-grid-section-wrapper ' . esc_attr( $grid_row_classes ) . '" ' . esc_attr( $grid_row_datas ) . ' ' . biagiotti_mikado_get_inline_style( $mkdf_grid_row_styles ) . '><div class="mkdf-row-grid-section">';
	$mkdf_row_wrapper_end   .= '</div></div>';
}

$mkdf_after_wrapper_open   = apply_filters('biagiotti_mikado_filter_vc_after_wrapper_open', '', $atts);
$mkdf_before_wrapper_close = apply_filters('biagiotti_mikado_filter_vc_before_wrapper_close', '', $atts);
$css_classes                = apply_filters('biagiotti_mikado_filter_vc_css_classes', $css_classes, $atts);

/***** Our code modification - end *****/

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= $mkdf_row_wrapper_start;
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' ' . biagiotti_mikado_get_inline_style( $mkdf_vc_row_styles ) . '>';
$output .= $mkdf_after_wrapper_open;
$output .= $mkdf_bg_svg_html;
$output .= $mkdf_bg_text_html;
$output .= wpb_js_remove_wpautop( $content );
$output .= $mkdf_before_wrapper_close;
$output .= '</div>';
$output .= $mkdf_row_wrapper_end;
$output .= $after_output;

echo biagiotti_mikado_get_module_part( $output );
