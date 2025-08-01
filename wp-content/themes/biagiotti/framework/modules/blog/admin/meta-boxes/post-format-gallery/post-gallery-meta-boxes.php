<?php

if ( ! function_exists( 'biagiotti_mikado_map_post_gallery_meta' ) ) {
	
	function biagiotti_mikado_map_post_gallery_meta() {
		$gallery_post_format_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'biagiotti' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		biagiotti_mikado_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'biagiotti' ),
				'description' => esc_html__( 'Choose your gallery images', 'biagiotti' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_map_post_gallery_meta', 21 );
}
