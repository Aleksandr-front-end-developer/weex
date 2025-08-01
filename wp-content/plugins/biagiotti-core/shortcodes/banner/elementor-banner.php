<?php

class BiagiottiCoreElementorBanner extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_banner';
    }

    public function get_title() {
        return esc_html__( 'Banner', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-banner';
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
            'image',
            [
                'label'       => esc_html__( 'Image', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select image from media library', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__( 'Image Overlay Color', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'hover_behavior',
            [
                'label'   => esc_html__( 'Hover Behavior', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'mkdf-visible-on-hover'   => esc_html__( 'Visible on Hover', 'biagiotti-core' ),
                    'mkdf-visible-on-default' => esc_html__( 'Visible on Default', 'biagiotti-core' ),
                    'mkdf-disabled'           => esc_html__( 'Disabled', 'biagiotti-core' ),
                ],
				'default' => 'mkdf-visible-on-default'
            ]
        );

        $this->add_control(
            'info_position',
            [
                'label'   => esc_html__( 'Info Position', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default'  => esc_html__( 'Default', 'biagiotti-core' ),
                    'centered' => esc_html__( 'Centered', 'biagiotti-core' ),
                    'right' => esc_html__( 'Right', 'biagiotti-core' ),
                    'top' => esc_html__( 'Top', 'biagiotti-core' ),
                ],
				'default' => 'default'
            ]
        );

        $this->add_control(
            'info_content_padding',
            [
                'label'       => esc_html__( 'Info Content Padding', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Please insert padding in format top right bottom left', 'biagiotti-core' )
            ]
        );

		$this->add_control(
			'info_border_display',
			[
				'label'   => esc_html__( 'Info Border Display', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'yes'  => esc_html__( 'Yes', 'biagiotti-core' ),
					'no' => esc_html__( 'No', 'biagiotti-core' ),
				],
				'default' => 'yes'
			]
		);

		$this->add_control(
			'info_border_color',
			[
				'label'       => esc_html__( 'Info Content Border Color', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'info_border_display' => 'yes'
				],
			]
		);

		$this->add_control(
			'custom_title',
			[
				'label' => esc_html__( 'Custom Title', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'custom_title_padding',
			[
				'label' => esc_html__( 'Custom Title Padding', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert padding in format top right bottom left', 'biagiotti-core' ),
				'condition' => [
					'custom_title!' => ''
				],
			]
		);

		$this->add_control(
			'custom_title_tag',
			[
				'label'     => esc_html__( 'Custom Title Tag', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
				'condition' => [
					'title!' => ''
				],
				'default' => 'p'

			]
		);

		$this->add_control(
			'custom_title_font_size',
			[
				'label' => esc_html__( 'Custom Title Font Size (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'custom_title!' => ''
				],
			]
		);

		$this->add_control(
			'custom_title_line_height',
			[
				'label' => esc_html__( 'Custom Title Line Height (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'custom_title!' => ''
				],
			]
		);

		$this->add_control(
			'custom_title_color',
			[
				'label' => esc_html__( 'Custom Title Color', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'custom_title!' => ''
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);


		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
				'condition' => [
					'title!' => ''
				],
				'default' => 'h3'
			]
		);

		$this->add_control(
			'title_light_words',
			[
				'label' => esc_html__( 'Words with Light Font Weight', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter the positions of the words you would like to display in a "light" font weight. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a light font weight, you would enter "1,3,4")', 'biagiotti-core' ),
				'condition' => [
					'title!' => ''
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				],
			]
		);

		$this->add_control(
			'title_top_margin',
			[
				'label' => esc_html__( 'Title Top Margin (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'title!' => ''
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'subtitle_tag',
			[
				'label'     => esc_html__( 'Subtitle Tag', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
				'condition' => [
					'subtitle!' => ''
				],
				'default' => 'h5'
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'subtitle!' => ''
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'target',
			[
				'label'     => esc_html__( 'Target', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_link_target_array(),
				'condition' => [
					'link!' => ''
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''  => esc_html__( 'Default', 'biagiotti-core' ),
					'predefined1' => esc_html__( 'Predefined 1', 'biagiotti-core' ),
					'predefined2' => esc_html__( 'Predefined 2', 'biagiotti-core' ),
				],
				'default' => ''
			]
		);


        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

		if ( ! empty( $params['image'] ) ) {
			$params['image'] = $params['image']['id'];
		}

		$params['holder_classes']      = $this->getHolderClasses( $params );
		$params['overlay_styles']      = $this->getOverlayStyles( $params );
		$params['custom_title_styles'] = $this->getCustomTleStyles( $params );
		$params['title']               = $this->getModifiedTitle( $params );
		$params['title_styles']        = $this->getTitleStyles( $params );
		$params['subtitle_styles']     = $this->getSubitleStyles( $params );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/banner', 'banner', '', $params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['hover_behavior'];
		$holderClasses[] = 'mkdf-banner-info-' . $params['info_position'];
		$holderClasses[] = 'mkdf-banner-' . $params['layout'] . '-layout';

		return implode( ' ', $holderClasses );
	}

	private function getOverlayStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['overlay_color'] ) ) {
			$styles[] = 'background-color: ' . $params['overlay_color'];
		}

		if ( ! empty( $params['info_content_padding'] ) ) {
			$styles[] = 'padding: ' . $params['info_content_padding'];
		}

		if ( $params['info_border_display'] === 'yes' ) {
			if ( ! empty( $params['info_border_color'] ) ) {
				$styles[] = 'border-color: ' . $params['info_border_color'];
			}
		} else {
			$styles[] = 'border: 0';
		}

		return implode( ';', $styles );
	}

	private function getCustomTleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['custom_title_padding'] ) ) {
			$styles[] = 'padding: ' . $params['custom_title_padding'];
		}

		if ( ! empty( $params['custom_title_font_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['custom_title_font_size'] ) . 'px';
		}

		if ( ! empty( $params['custom_title_line_height'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['custom_title_line_height'] ) . 'px';
		}

		if ( ! empty( $params['custom_title_color'] ) ) {
			$styles[] = 'color: ' . $params['custom_title_color'];
		}

		return implode( ';', $styles );
	}

	private function getSubitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}

		return implode( ';', $styles );
	}

	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_light_words = str_replace( ' ', '', $params['title_light_words'] );

		if ( ! empty( $title ) ) {
			$light_words = explode( ',', $title_light_words );
			$split_title = explode( ' ', $title );

			if ( ! empty( $title_light_words ) ) {
				foreach ( $light_words as $value ) {
					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="mkdf-banner-title-light">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}

			$title = implode( ' ', $split_title );
		}

		return $title;
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		if ( ! empty( $params['title_top_margin'] ) ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['title_top_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorBanner() );
