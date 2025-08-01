<?php

class BiagiottiCoreElementorIconWithText extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkd_icon_with_text';
    }

    public function get_title() {
        return esc_html__( 'Icon With Text', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-icon-with-text';
    }

    public function get_categories() {
        return [ 'mikado' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'biagiotti-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'label'       => esc_html__( 'Custom CSS Class', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => esc_html__( 'Type', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'icon-left'            => esc_html__( 'Icon Left From Text', 'biagiotti-core' ),
                    'icon-left-from-title' => esc_html__( 'Icon Left From Title', 'biagiotti-core' ),
                    'icon-top'             => esc_html__( 'Icon Top', 'biagiotti-core' ),
                ],
                'default' => 'icon-left'
            ]
        );

        biagiotti_mikado_icon_collections()->getElementorParamsArray( $this, '', '' );

        $this->add_control(
            'custom_icon',
            [
                'label'       => esc_html__( 'Custom Icon', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
            ]
        );

		$this->add_control(
			'background_icon',
			[
				'label'   => esc_html__( 'Background Icon', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'type' => array( 'icon-top' )
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => esc_html__( 'Title', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'text',
			[
				'label'   => esc_html__( 'Text', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'link',
			[
				'label'   => esc_html__( 'Link', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Set link around icon and title', 'biagiotti-core' )
			]
		);

		$this->add_control(
			'target',
			[
				'label'   => esc_html__( 'Target', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'options' => biagiotti_mikado_get_link_target_array(),
				'condition' => [
					'link!' => ''
				]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_settings',
            [
                'label' => esc_html__( 'Icon Settings', 'biagiotti-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'   => esc_html__( 'Icon Type', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'mkdf-normal' => esc_html__( 'Normal', 'biagiotti-core' ),
                    'mkdf-circle' => esc_html__( 'Circle', 'biagiotti-core' ),
                    'mkdf-square' => esc_html__( 'Square', 'biagiotti-core' ),
                ],
                'default' => 'mkdf-normal'
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'   => esc_html__( 'Icon Size', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'mkdf-icon-medium' => esc_html__( 'Medium', 'biagiotti-core' ),
                    'mkdf-icon-tiny'   => esc_html__( 'Tiny', 'biagiotti-core' ),
                    'mkdf-icon-small'  => esc_html__( 'Small', 'biagiotti-core' ),
                    'mkdf-icon-large'  => esc_html__( 'Large', 'biagiotti-core' ),
                    'mkdf-icon-huge'   => esc_html__( 'Very Large', 'biagiotti-core' ),
                ],
                'default' => 'mkdf-icon-medium'
            ]
        );

        $this->add_control(
            'custom_icon_size',
            [
                'label'   => esc_html__( 'Custom Icon Size (px)', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'shape_size',
            [
                'label'   => esc_html__( 'Shape Size (px)', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'   => esc_html__( 'Icon Hover Color', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'icon_background_color',
            [
                'label'   => esc_html__( 'Icon Background Color', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_hover_background_color',
            [
                'label'   => esc_html__( 'Icon Hover Background Color', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_border_color',
            [
                'label'   => esc_html__( 'Icon Border Color', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_border_hover_color',
            [
                'label'   => esc_html__( 'Icon Border Hover Color', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_border_width',
            [
                'label'   => esc_html__( 'Border Width (px)', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
                ],
            ]
        );

        $this->add_control(
            'icon_animation',
            [
                'label'   => esc_html__( 'Icon Animation', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false )
            ]
        );

        $this->add_control(
            'icon_animation_delay',
            [
                'label'   => esc_html__( 'Icon Animation Delay (ms)', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'icon_animation' => array( 'yes' )
                ],
            ]
        );



		$this->end_controls_section();


		$this->start_controls_section(
			'background_icon_settings',
			[
				'label' => esc_html__( 'Background Icon Settings', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'bg_scale_size',
			[
				'label'   => esc_html__( 'Background Icon Settings', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'background_icon!' => ''
				],
				'description' => esc_html__( 'Set scale size (example: 1.2 )', 'biagiotti-core' )
			]
		);

		$this->add_control(
			'bg_margin',
			[
				'label'   => esc_html__( 'Background Margin (px)', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'background_icon!' => ''
				],
			]
		);

		$this->end_controls_section();


        $this->start_controls_section(
            'text_settings',
            [
                'label' => esc_html__( 'Text Settings', 'biagiotti-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Title Tag', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_title_tag( true ),
                'condition' => [
                    'title!' => ''
                ],
                'default' => 'h4'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'   => esc_html__( 'Title Color', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'title_top_margin',
            [
                'label'   => esc_html__( 'Title Top Margin (px)', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'   => esc_html__( 'Text Color', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

        $this->add_control(
            'text_top_margin',
            [
                'label'   => esc_html__( 'Text Top Margin (px)', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'text!' => ''
                ]
            ]
        );

		$this->add_control(
			'text_padding',
			[
				'label'   => esc_html__( 'Text Top/Left Padding (px)', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => array( 'icon-left', 'icon-top' )
				],
				'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'biagiotti-core' ),
			]
		);

        $this->end_controls_section();

    }

    public function render() {
        $params = $this->get_settings_for_display();



        if ( ! empty( $params['custom_icon'] ) ) {
            $params['custom_icon'] = $params['custom_icon']['id'];
        }

		if ( ! empty( $params['background_icon'] ) ) {
			$params['background_icon'] = $params['background_icon']['id'];
		}

		$params['bg_icon_parameters'] = $this->getBgIconParameters( $params );
		$params['icon_parameters']    = $this->getIconParameters( $params );
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['content_styles']     = $this->getContentStyles( $params );
		$params['title_styles']       = $this->getTitleStyles( $params );
		$params['text_styles']        = $this->getTextStyles( $params );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/iwt', 'icon-with-text', $params['type'], $params );
    }

	private function getBgIconParameters( $params ) {
		$params_array = array();

		if ( ! empty( $params['background_icon'] ) ) {

			if ( ! empty( $params['bg_scale_size'] ) ) {
				$params_array['bg_scale_size'] = 'transform: scale(' . ( $params['bg_scale_size'] ) . ')';
			}

			if ( $params['bg_margin'] !== '' ) {
				$params_array[] = 'margin: ' . biagiotti_mikado_filter_px( $params['bg_margin'] ) . 'px';
			}
		}

		return $params_array;
	}

	private function getIconParameters( $params ) {
		$params_array = array();

		if ( empty( $params['custom_icon'] ) ) {
			$iconPackName = biagiotti_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );

			$params_array['icon_pack']     = $params['icon_pack'];
			$params_array[ $iconPackName ] = $params[ $iconPackName ];

			if ( ! empty( $params['icon_size'] ) ) {
				$params_array['size'] = $params['icon_size'];
			}

			if ( ! empty( $params['custom_icon_size'] ) ) {
				$params_array['custom_size'] = biagiotti_mikado_filter_px( $params['custom_icon_size'] ) . 'px';
			}

			if ( ! empty( $params['icon_type'] ) ) {
				$params_array['type'] = $params['icon_type'];
			}

			if ( ! empty( $params['shape_size'] ) ) {
				$params_array['shape_size'] = biagiotti_mikado_filter_px( $params['shape_size'] ) . 'px';
			}

			if ( ! empty( $params['icon_border_color'] ) ) {
				$params_array['border_color'] = $params['icon_border_color'];
			}

			if ( ! empty( $params['icon_border_hover_color'] ) ) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}

			if ( $params['icon_border_width'] !== '' ) {
				$params_array['border_width'] = biagiotti_mikado_filter_px( $params['icon_border_width'] ) . 'px';
			}

			if ( ! empty( $params['icon_background_color'] ) ) {
				$params_array['background_color'] = $params['icon_background_color'];
			}

			if ( ! empty( $params['icon_hover_background_color'] ) ) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}

			$params_array['icon_color'] = $params['icon_color'];

			if ( ! empty( $params['icon_hover_color'] ) ) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}

			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}

		return $params_array;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array( 'mkdf-iwt', 'clearfix' );

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-iwt-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['icon_size'] ) ? 'mkdf-iwt-' . str_replace( 'mkdf-', '', $params['icon_size'] ) : '';

		return $holderClasses;
	}

	private function getContentStyles( $params ) {
		$styles = array();

		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-left' ) {
			$styles[] = 'padding-left: ' . biagiotti_mikado_filter_px( $params['text_padding'] ) . 'px';
		}

		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-top' ) {
			$styles[] = 'padding-top: ' . biagiotti_mikado_filter_px( $params['text_padding'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['title_top_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getTextStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}

		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['text_top_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorIconWithText() );