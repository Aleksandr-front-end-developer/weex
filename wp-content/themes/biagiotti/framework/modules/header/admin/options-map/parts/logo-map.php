<?php

if ( ! function_exists( 'biagiotti_mikado_logo_options_map' ) ) {
	function biagiotti_mikado_logo_options_map() {
		
		biagiotti_mikado_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'biagiotti' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = biagiotti_mikado_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'biagiotti' )
			)
		);
		
		$hide_logo_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
            array(
                'parent'        => $hide_logo_container,
                'type'          => 'select',
                'name'          => 'logo_source',
                'default_value' => 'image',
                'label'         => esc_html__( 'Select Logo Source', 'biagiotti' ),
                'description'   => esc_html__( 'Choose whether you would like to use logo as image or text', 'biagiotti' ),
                'options'       => array(
                    'image' => esc_html__( 'Image', 'biagiotti' ),
                    'text' => esc_html__( 'Text', 'biagiotti' )
                )
            )
        );

        $image_logo_container = biagiotti_mikado_add_admin_container(
            array(
                'parent'          => $hide_logo_container,
                'name'            => 'image_logo_container',
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'text'
                    )
                )
            )
        );

		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => BIAGIOTTI_MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'biagiotti' ),
				'parent'        => $image_logo_container
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => BIAGIOTTI_MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'biagiotti' ),
				'parent'        => $image_logo_container
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => BIAGIOTTI_MIKADO_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'biagiotti' ),
				'parent'        => $image_logo_container
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => BIAGIOTTI_MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'biagiotti' ),
				'parent'        => $image_logo_container
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => BIAGIOTTI_MIKADO_ASSETS_ROOT . "/img/logo-mobile.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'biagiotti' ),
				'parent'        => $image_logo_container
			)
		);

        biagiotti_mikado_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'text',
                'name'        => 'logo_text',
                'label'       => esc_html__( 'Logo Text', 'biagiotti' ),
                'description' => esc_html__( 'Enter your logo text here', 'biagiotti' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                )
            )
        );

        biagiotti_mikado_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'color',
                'name'        => 'logo_text_color',
                'label'       => esc_html__( 'Logo Text Color', 'biagiotti' ),
                'description' => esc_html__( 'Choose color for your logo text', 'biagiotti' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                )
            )
        );

		biagiotti_mikado_add_admin_field(
			array(
				'parent'      => $hide_logo_container,
				'type'        => 'text',
				'name'        => 'mobile_logo_text',
				'label'       => esc_html__( 'Mobile Logo Text', 'biagiotti' ),
				'description' => esc_html__( 'Enter your logo text here for mobile device', 'biagiotti' ),
				'dependency' => array(
					'hide' => array(
						'logo_source'  => 'image'
					)
				)
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_options_map', 'biagiotti_mikado_logo_options_map', biagiotti_mikado_set_options_map_position( 'logo' ) );
}