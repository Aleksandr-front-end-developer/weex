<?php

if ( ! function_exists( 'biagiotti_mikado_set_search_fullscreen_with_sidebar_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function biagiotti_mikado_set_search_fullscreen_with_sidebar_global_option( $search_type_options ) {
        $search_type_options['fullscreen-with-sidebar'] = esc_html__( 'Fullscreen With Sidebar', 'biagiotti' );

        return $search_type_options;
    }

    add_filter( 'biagiotti_mikado_filter_search_type_global_option', 'biagiotti_mikado_set_search_fullscreen_with_sidebar_global_option' );
}


if ( ! function_exists( 'biagiotti_mikado_register_search_sidebar' ) ) {
    function biagiotti_mikado_register_search_sidebar(){

        register_sidebar(
            array(
                'id' => 'fullscreen_search_column_1',
                'name' => esc_html__('FullScreen Search Column 1', 'biagiotti'),
                'description' => esc_html__('Widgets added here will appear in the first column of fullscreen search', 'biagiotti'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-fullscreen-search-column-1 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkdf-widget-title-holder"><h6 class="mkdf-widget-title">',
                'after_title' => '</h6></div>'
            )
        );

        register_sidebar(
            array(
                'id' => 'fullscreen_search_column_2',
                'name' => esc_html__('FullScreen Search Column 2', 'biagiotti'),
                'description' => esc_html__('Widgets added here will appear in the second column of fullscreen search', 'biagiotti'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-fullscreen-search-column-2 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkdf-widget-title-holder"><h6 class="mkdf-widget-title">',
                'after_title' => '</h6></div>'
            )
        );

        register_sidebar(
            array(
                'id' => 'fullscreen_search_column_3',
                'name' => esc_html__('FullScreen Search Column 3', 'biagiotti'),
                'description' => esc_html__('Widgets added here will appear in the third column of fullscreen search', 'biagiotti'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-fullscreen-search-column-3 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkdf-widget-title-holder"><h6 class="mkdf-widget-title">',
                'after_title' => '</h6></div>'
            )
        );
    }

    add_action( 'widgets_init', 'biagiotti_mikado_register_search_sidebar' );
}

if ( ! function_exists( 'biagiotti_mikado_search_sidebar_columns_dependency_fullscreen_with_sidebar' ) ) {
	/**
	 * Add dependency for 'search_in_grid' field type
	 * @param $dependency_array
	 * * @return array modified array of dependecies
	 */
	function biagiotti_mikado_search_sidebar_columns_dependency_fullscreen_with_sidebar($dependency_array) {

		$dependency_array[] = 'fullscreen-with-sidebar';

		return $dependency_array;
	}

	add_filter( 'search_sidebar_columns_dependency', 'biagiotti_mikado_search_sidebar_columns_dependency_fullscreen_with_sidebar' );
}