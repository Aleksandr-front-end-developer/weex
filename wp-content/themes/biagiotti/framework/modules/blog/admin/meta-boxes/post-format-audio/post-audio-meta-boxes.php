<?php

if ( ! function_exists( 'biagiotti_mikado_map_post_audio_meta' ) ) {
	function biagiotti_mikado_map_post_audio_meta() {
		$audio_post_format_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'biagiotti' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'biagiotti' ),
				'description'   => esc_html__( 'Choose audio type', 'biagiotti' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'biagiotti' ),
					'self'            => esc_html__( 'Self Hosted', 'biagiotti' )
				)
			)
		);
		
		$mkdf_audio_embedded_container = biagiotti_mikado_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'mkdf_audio_embedded_container'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'biagiotti' ),
				'description' => esc_html__( 'Enter audio URL', 'biagiotti' ),
				'parent'      => $mkdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'biagiotti' ),
				'description' => esc_html__( 'Enter audio link', 'biagiotti' ),
				'parent'      => $mkdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_map_post_audio_meta', 23 );
}