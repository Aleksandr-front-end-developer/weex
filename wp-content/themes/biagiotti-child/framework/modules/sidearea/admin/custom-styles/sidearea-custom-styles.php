<?php

if ( ! function_exists( 'biagiotti_mikado_side_area_slide_from_right_type_style' ) ) {
	function biagiotti_mikado_side_area_slide_from_right_type_style() {
		
		if ( biagiotti_mikado_options()->getOptionValue( 'side_area_type' ) == 'side-menu-slide-from-right' ) {
			
			if ( biagiotti_mikado_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo biagiotti_mikado_dynamic_css( '.mkdf-side-menu-slide-from-right .mkdf-side-menu', array(
					'right' => '-' . biagiotti_mikado_options()->getOptionValue( 'side_area_width' ),
					'width' => biagiotti_mikado_options()->getOptionValue( 'side_area_width' )
				) );
			}
			
			if ( biagiotti_mikado_options()->getOptionValue( 'side_area_content_overlay_color' ) !== '' ) {
				
				echo biagiotti_mikado_dynamic_css( '.mkdf-side-menu-slide-from-right .mkdf-wrapper .mkdf-cover', array(
					'background-color' => biagiotti_mikado_options()->getOptionValue( 'side_area_content_overlay_color' )
				) );
			}
			
			if ( biagiotti_mikado_options()->getOptionValue( 'side_area_content_overlay_opacity' ) !== '' ) {
				
				echo biagiotti_mikado_dynamic_css( '.mkdf-side-menu-slide-from-right.mkdf-right-side-menu-opened .mkdf-wrapper .mkdf-cover', array(
					'opacity' => biagiotti_mikado_options()->getOptionValue( 'side_area_content_overlay_opacity' )
				) );
			}
		}
	}
	
	add_action( 'biagiotti_mikado_action_style_dynamic', 'biagiotti_mikado_side_area_slide_from_right_type_style' );
}

if ( ! function_exists( 'biagiotti_mikado_side_area_slide_with_content_type_style' ) ) {
	function biagiotti_mikado_side_area_slide_with_content_type_style() {
		
		if ( biagiotti_mikado_options()->getOptionValue( 'side_area_type' ) == 'side-menu-slide-with-content' ) {
			
			if ( biagiotti_mikado_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo biagiotti_mikado_dynamic_css( '.mkdf-side-menu-slide-with-content .mkdf-side-menu', array(
					'right' => '-' . biagiotti_mikado_options()->getOptionValue( 'side_area_width' ),
					'width' => biagiotti_mikado_options()->getOptionValue( 'side_area_width' )
				) );
				
				$side_menu_open_classes = array(
					'.mkdf-side-menu-slide-with-content.mkdf-side-menu-open .mkdf-wrapper',
					'.mkdf-side-menu-slide-with-content.mkdf-side-menu-open footer.uncover',
					'.mkdf-side-menu-slide-with-content.mkdf-side-menu-open .mkdf-sticky-header',
					'.mkdf-side-menu-slide-with-content.mkdf-side-menu-open .mkdf-fixed-wrapper',
					'.mkdf-side-menu-slide-with-content.mkdf-side-menu-open .mkdf-mobile-header-inner',
				);
				
				echo biagiotti_mikado_dynamic_css( $side_menu_open_classes, array(
					'left' => '-' . biagiotti_mikado_options()->getOptionValue( 'side_area_width' ),
				) );
			}
		}
	}
	
	add_action( 'biagiotti_mikado_action_style_dynamic', 'biagiotti_mikado_side_area_slide_with_content_type_style' );
}

if ( ! function_exists( 'biagiotti_mikado_side_area_uncovered_from_content_type_style' ) ) {
	function biagiotti_mikado_side_area_uncovered_from_content_type_style() {
		
		if ( biagiotti_mikado_options()->getOptionValue( 'side_area_type' ) == 'side-area-uncovered-from-content' ) {
			
			if ( biagiotti_mikado_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo biagiotti_mikado_dynamic_css( '.mkdf-side-area-uncovered-from-content .mkdf-side-menu', array(
					'width' => biagiotti_mikado_options()->getOptionValue( 'side_area_width' )
				) );
				
				$side_menu_open_classes = array(
					'.mkdf-side-area-uncovered-from-content.mkdf-right-side-menu-opened .mkdf-wrapper',
					'.mkdf-side-area-uncovered-from-content.mkdf-right-side-menu-opened footer.uncover',
					'.mkdf-side-area-uncovered-from-content.mkdf-right-side-menu-opened .mkdf-sticky-header',
					'.mkdf-side-area-uncovered-from-content.mkdf-right-side-menu-opened .mkdf-fixed-wrapper.fixed',
					'.mkdf-side-area-uncovered-from-content.mkdf-right-side-menu-opened .mkdf-mobile-header-inner',
					'.mkdf-side-area-uncovered-from-content.mkdf-right-side-menu-opened .mobile-header-appear .mkdf-mobile-header-inner',
				);
				
				echo biagiotti_mikado_dynamic_css( $side_menu_open_classes, array(
					'left' => '-' . biagiotti_mikado_options()->getOptionValue( 'side_area_width' ),
				) );
			}
		}
	}
	
	add_action( 'biagiotti_mikado_action_style_dynamic', 'biagiotti_mikado_side_area_uncovered_from_content_type_style' );
}

if ( ! function_exists( 'biagiotti_mikado_side_area_icon_color_styles' ) ) {
	function biagiotti_mikado_side_area_icon_color_styles() {
		$icon_color             = biagiotti_mikado_options()->getOptionValue( 'side_area_icon_color' );
		$icon_hover_color       = biagiotti_mikado_options()->getOptionValue( 'side_area_icon_hover_color' );
		$close_icon_color       = biagiotti_mikado_options()->getOptionValue( 'side_area_close_icon_color' );
		$close_icon_hover_color = biagiotti_mikado_options()->getOptionValue( 'side_area_close_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.mkdf-side-menu-button-opener:hover',
			'.mkdf-side-menu-button-opener.opened'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo biagiotti_mikado_dynamic_css( '.mkdf-side-menu-button-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo biagiotti_mikado_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color
			) );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			echo biagiotti_mikado_dynamic_css( '.mkdf-side-menu a.mkdf-close-side-menu', array(
				'color' => $close_icon_color
			) );
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			echo biagiotti_mikado_dynamic_css( '.mkdf-side-menu a.mkdf-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			) );
		}
	}
	
	add_action( 'biagiotti_mikado_action_style_dynamic', 'biagiotti_mikado_side_area_icon_color_styles' );
}

if ( ! function_exists( 'biagiotti_mikado_side_area_styles' ) ) {
	function biagiotti_mikado_side_area_styles() {
		$side_area_styles = array();
		$background_color = biagiotti_mikado_options()->getOptionValue( 'side_area_background_color' );
		$padding          = biagiotti_mikado_options()->getOptionValue( 'side_area_padding' );
		$text_alignment   = biagiotti_mikado_options()->getOptionValue( 'side_area_aligment' );
		
		if ( ! empty( $background_color ) ) {
			$side_area_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $padding ) ) {
			$side_area_styles['padding'] = esc_attr( $padding );
		}
		
		if ( ! empty( $text_alignment ) ) {
			$side_area_styles['text-align'] = $text_alignment;
		}
		
		if ( ! empty( $side_area_styles ) ) {
			echo biagiotti_mikado_dynamic_css( '.mkdf-side-menu', $side_area_styles );
		}
		
		if ( $text_alignment === 'center' ) {
			echo biagiotti_mikado_dynamic_css( '.mkdf-side-menu .widget img', array(
				'margin' => '0 auto'
			) );
		}
	}
	
	add_action( 'biagiotti_mikado_action_style_dynamic', 'biagiotti_mikado_side_area_styles' );
}