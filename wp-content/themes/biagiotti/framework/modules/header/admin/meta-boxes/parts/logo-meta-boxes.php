<?php

if ( ! function_exists( 'biagiotti_mikado_logo_meta_box_map' ) ) {
	function biagiotti_mikado_logo_meta_box_map() {
		
		$logo_meta_box = biagiotti_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'biagiotti_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'biagiotti' ),
				'name'  => 'logo_meta'
			)
		);
		
		biagiotti_mikado_create_meta_box_field(
            array(
                'parent'        => $logo_meta_box,
                'type'          => 'select',
                'name'          => 'mkdf_logo_source_meta',
                'default_value' => '',
                'label'         => esc_html__( 'Select Logo Source', 'biagiotti' ),
                'description'   => esc_html__( 'Choose whether you would like to use logo as image or text', 'biagiotti' ),
                'options'       => array(
                    ''     => esc_html__('Default', 'biagiotti'),
                    'image' => esc_html__( 'Image', 'biagiotti' ),
                    'text' => esc_html__( 'Text', 'biagiotti' )
                )
            )
        );

        $image_logo_container = biagiotti_mikado_add_admin_container(
            array(
                'parent'          => $logo_meta_box,
                'name'            => 'image_logo_container',
                'dependency' => array(
                    'hide' => array(
                        'mkdf_logo_source_meta'  => 'text'
                    )
                )
            )
        );

		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'biagiotti' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'biagiotti' ),
				'parent'      => $image_logo_container
			)
		);

		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'biagiotti' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'biagiotti' ),
				'parent'      => $image_logo_container
			)
		);

		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'biagiotti' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'biagiotti' ),
				'parent'      => $image_logo_container
			)
		);

		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'biagiotti' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'biagiotti' ),
				'parent'      => $image_logo_container
			)
		);

		biagiotti_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'biagiotti' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'biagiotti' ),
				'parent'      => $image_logo_container
			)
		);

        biagiotti_mikado_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'text',
                'name'        => 'mkdf_logo_text_meta',
                'label'       => esc_html__( 'Logo Text', 'biagiotti' ),
                'description' => esc_html__( 'Enter your logo text', 'biagiotti' ),
                'dependency' => array(
                    'hide' => array(
                        'mkdf_logo_source_meta'  => 'image'
                    )
                )
            )
        );

        biagiotti_mikado_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'color',
                'name'        => 'mkdf_logo_text_color_meta',
                'label'       => esc_html__( 'Logo Text Color', 'biagiotti' ),
                'description' => esc_html__( 'Choose color for your logo text', 'biagiotti' ),
                'dependency' => array(
                    'hide' => array(
                        'mkdf_logo_source_meta'  => 'image'
                    )
                )
            )
        );

		biagiotti_mikado_create_meta_box_field(
			array(
				'parent'      => $logo_meta_box,
				'type'        => 'text',
				'name'        => 'mkdf_mobile_logo_text_meta',
				'label'       => esc_html__( 'Mobile Logo Text', 'biagiotti' ),
				'description' => esc_html__( 'Enter your logo text for mobile device', 'biagiotti' ),
				'dependency' => array(
					'hide' => array(
						'mkdf_logo_source_meta'  => 'image'
					)
				)
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_meta_boxes_map', 'biagiotti_mikado_logo_meta_box_map', 47 );
}