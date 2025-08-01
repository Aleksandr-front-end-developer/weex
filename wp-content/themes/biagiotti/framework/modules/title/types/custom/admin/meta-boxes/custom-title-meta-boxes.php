<?php

if ( ! function_exists( 'biagiotti_mikado_custom_title_type_options_meta_boxes' ) ) {
	function biagiotti_mikado_custom_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_subtitle_left_offset_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Left Offset', 'biagiotti' ),
				'description' => esc_html__( 'Set left offset for subtitle area', 'biagiotti' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				),
				'dependency'  => array(
                    'show' => array(
                        'mkdf_title_area_type_meta' => 'custom'
                    )
                )
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_additional_title_area_meta_boxes', 'biagiotti_mikado_custom_title_type_options_meta_boxes', 5 );
}