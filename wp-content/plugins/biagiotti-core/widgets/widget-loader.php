<?php

if ( ! function_exists( 'biagiotti_core_register_widgets' ) ) {
	function biagiotti_core_register_widgets() {
		$widgets = apply_filters( 'biagiotti_core_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'biagiotti_core_register_widgets' );
}