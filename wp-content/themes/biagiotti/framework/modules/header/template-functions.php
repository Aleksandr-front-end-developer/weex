<?php
use BiagiottiMikadoNamespace\Modules\Header\Lib\HeaderFactory;

if ( ! function_exists( 'biagiotti_mikado_get_header' ) ) {
	/**
	 * Loads header HTML based on header type option. Sets all necessary parameters for header
	 * and defines biagiotti_mikado_filter_header_type_parameters filter
	 */
	function biagiotti_mikado_get_header() {
		$id = biagiotti_mikado_get_page_id();
		
		//will be read from options
		$header_type = biagiotti_mikado_get_meta_field_intersect( 'header_type', $id );
		
		$menu_area_in_grid = biagiotti_mikado_get_meta_field_intersect( 'menu_area_in_grid', $id );
		
		$header_behavior = biagiotti_mikado_get_meta_field_intersect( 'header_behaviour', $id );
		
		if ( HeaderFactory::getInstance()->validHeaderObject() ) {
			$parameters = array(
				'hide_logo'          => biagiotti_mikado_options()->getOptionValue( 'hide_logo' ) == 'yes',
				'menu_area_in_grid'  => $menu_area_in_grid == 'yes',
				'show_sticky'        => in_array( $header_behavior, array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ) ),
				'show_fixed_wrapper' => in_array( $header_behavior, array( 'fixed-on-scroll' ) ),
			);
			
			$parameters = apply_filters( 'biagiotti_mikado_filter_header_type_parameters', $parameters, $header_type );
			
			HeaderFactory::getInstance()->getHeaderObject()->loadTemplate( $parameters );
		}
	}
    add_action( 'biagiotti_mikado_action_after_wrapper_inner', 'biagiotti_mikado_get_header', 10 );
}

if ( ! function_exists( 'biagiotti_mikado_get_logo' ) ) {
	/**
	 * Loads logo HTML
	 *
	 * @param $slug
	 */
	function biagiotti_mikado_get_logo( $slug = '' ) {
		$id            = biagiotti_mikado_get_page_id();
		$header_height = biagiotti_mikado_set_default_menu_height_for_header_types();
		
		if ( $slug == 'sticky' ) {
			$logo_image = biagiotti_mikado_get_meta_field_intersect( 'logo_image_sticky', $id );
		} else {
			$logo_image = biagiotti_mikado_get_meta_field_intersect( 'logo_image', $id );
		}
		
		$logo_image_dark  = biagiotti_mikado_get_meta_field_intersect( 'logo_image_dark', $id );
		$logo_image_light = biagiotti_mikado_get_meta_field_intersect( 'logo_image_light', $id );
		
		//get logo image dimensions and set style attribute for image link.
		$logo_dimensions = biagiotti_mikado_get_image_dimensions( $logo_image );
		
		$logo_styles = '';
		if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
			$logo_height = $logo_dimensions['height'];
			$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px;'; //divided with 2 because of retina screens
		} else if ( ! empty( $header_height ) && empty( $logo_dimensions ) ) {
			$logo_styles = 'height: ' . intval( $header_height / 2 ) . 'px;'; //divided with 2 because of retina screens
		}
		
		$params = array(
			'logo_image'       => $logo_image,
			'logo_image_dark'  => $logo_image_dark,
			'logo_image_light' => $logo_image_light,
			'logo_styles'      => $logo_styles
		);

		$is_text_logo = biagiotti_mikado_get_meta_field_intersect( 'logo_source', $id ) == 'text' ? true : false;

		if ( $is_text_logo ) {
			$params['slug']            = 'text';
			$params['logo_text']       = biagiotti_mikado_get_meta_field_intersect( 'logo_text', $id );
			$params['logo_text_color'] = biagiotti_mikado_get_meta_field_intersect( 'logo_text_color', $id );
		}

		$params = apply_filters( 'biagiotti_mikado_filter_get_logo_html_parameters', $params );
		
		biagiotti_mikado_get_module_template_part( 'parts/logo', 'header', $slug, $params );
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_main_menu' ) ) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function biagiotti_mikado_get_main_menu( $additional_class = 'mkdf-default-nav' ) {
		biagiotti_mikado_get_module_template_part( 'parts/navigation', 'header', '', array( 'additional_class' => $additional_class ) );
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_header_widget_area_one' ) ) {
	/**
	 * Loads header widgets area HTML
	 */
	function biagiotti_mikado_get_header_widget_area_one() {
		$page_id                 = biagiotti_mikado_get_page_id();
		$custom_menu_widget_area = get_post_meta( $page_id, 'mkdf_custom_header_widget_area_one_meta', true );
		
		if ( get_post_meta( $page_id, 'mkdf_disable_header_widget_areas_meta', 'true' ) !== 'yes' ) {
			if ( is_active_sidebar( 'mkdf-header-widget-area-one' ) && empty( $custom_menu_widget_area ) ) {
				dynamic_sidebar( 'mkdf-header-widget-area-one' );
			} else if ( ! empty( $custom_menu_widget_area ) && is_active_sidebar( $custom_menu_widget_area ) ) {
				dynamic_sidebar( $custom_menu_widget_area );
			}
		}
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_header_widget_area_two' ) ) {
	/**
	 * Loads header widgets area HTML
	 */
	function biagiotti_mikado_get_header_widget_area_two() {
		$page_id                 = biagiotti_mikado_get_page_id();
		$custom_menu_widget_area = get_post_meta( $page_id, 'mkdf_custom_header_widget_area_two_meta', true );

		if ( get_post_meta( $page_id, 'mkdf_disable_header_widget_areas_meta', 'true' ) !== 'yes' ) {
			if ( is_active_sidebar( 'mkdf-header-widget-area-two' ) && empty( $custom_menu_widget_area ) ) {
				dynamic_sidebar( 'mkdf-header-widget-area-two' );
			} else if ( ! empty( $custom_menu_widget_area ) && is_active_sidebar( $custom_menu_widget_area ) ) {
				dynamic_sidebar( $custom_menu_widget_area );
			}
		}
	}
}

if ( ! function_exists( 'biagiotti_mikado_is_header_widget_area_active' ) ) {
	/**
	 * Check is header widgets area active
	 */
	function biagiotti_mikado_is_header_widget_area_active( $area ) {
		
		if ( empty( $area ) || ! in_array( $area, array( 'one', 'two' ) ) ) {
			return false;
		}
		
		$page_id                 = biagiotti_mikado_get_page_id();
		$custom_menu_widget_area = get_post_meta( $page_id, 'mkdf_custom_header_widget_area_' . $area . '_meta', true );
		$is_active               = false;
		
		if ( get_post_meta( $page_id, 'mkdf_disable_header_widget_areas_meta', 'true' ) !== 'yes' ) {
			if ( is_active_sidebar( 'mkdf-header-widget-area-' . $area ) && empty( $custom_menu_widget_area ) ) {
				$is_active = true;
			} else if ( ! empty( $custom_menu_widget_area ) && is_active_sidebar( $custom_menu_widget_area ) ) {
				$is_active = true;
			}
		}
		
		return $is_active;
	}
}