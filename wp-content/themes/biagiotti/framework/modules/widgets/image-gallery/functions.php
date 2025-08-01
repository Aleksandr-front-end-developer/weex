<?php

if ( ! function_exists( 'biagiotti_mikado_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function biagiotti_mikado_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'BiagiottiMikadoClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'biagiotti_core_filter_register_widgets', 'biagiotti_mikado_register_image_gallery_widget' );
}