<?php

/*** Post Settings ***/

if ( ! function_exists( 'biagiotti_mikado_map_post_meta' ) ) {
	function biagiotti_mikado_map_post_meta() {
		
		$post_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'biagiotti' ),
				'name'  => 'post-meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'biagiotti' ),
				'parent'        => $post_meta_box,
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'biagiotti' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'biagiotti' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => biagiotti_mikado_get_custom_sidebars_options( true )
			)
		);
		
		$biagiotti_custom_sidebars = biagiotti_mikado_get_custom_sidebars();
		if ( count( $biagiotti_custom_sidebars ) > 0 ) {
			biagiotti_mikado_create_meta_box_field( array(
				'name'        => 'mkdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'biagiotti' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'biagiotti' ),
				'parent'      => $post_meta_box,
				'options'     => biagiotti_mikado_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'biagiotti' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'biagiotti' ),
				'parent'      => $post_meta_box
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_single_center_content_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Center Content', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will center all content', 'biagiotti' ),
				'parent'        => $post_meta_box,
				'options'       => biagiotti_mikado_get_yes_no_select_array()
			)
		);

		do_action('biagiotti_mikado_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_map_post_meta', 20 );
}
