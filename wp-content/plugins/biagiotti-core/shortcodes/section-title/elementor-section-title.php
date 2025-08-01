<?php

class BiagiottiCoreElementorSectionTitle extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_section_title';
    }

    public function get_title() {
        return esc_html__( 'Section Title', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-section-title';
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
            'position',
            [
                'label'     => esc_html__( 'Horizontal Position', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    ''       => esc_html__( 'Default', 'biagiotti-core' ),
                    'left'   => esc_html__( 'Left', 'biagiotti-core' ),
                    'center' => esc_html__( 'Center', 'biagiotti-core' ),
                    'right'  => esc_html__( 'Right', 'biagiotti-core' ),
                ]
            ]
        );

        $this->add_control(
            'holder_padding',
            [
                'label' => esc_html__( 'Holder Side Padding (px or %)', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

		$this->add_control(
			'tagline',
			[
				'label' => esc_html__( 'Tagline', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
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
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
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
			'image_position',
			[
				'label'     => esc_html__( 'Image Position', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'top'       => esc_html__( 'Top', 'biagiotti-core' ),
					'bottom'   => esc_html__( 'Bottom', 'biagiotti-core' )
				],
				'condition' => [
					'image!' => ''
				],
				'default'   => 'bottom'
			]
		);

		$this->add_control(
			'image_top_margin',
			[
				'label' => esc_html__( 'Image Top Margin (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'image!' => ''
				],
			]
		);

		$this->add_control(
			'image_bottom_margin',
			[
				'label' => esc_html__( 'Image Bottom Margin (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'image!' => ''
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tagline_settings',
			[
				'label' => esc_html__( 'Tagline Style', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'tagline!' => ''
				],
			]
		);

		$this->add_control(
			'tagline_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   =>  biagiotti_mikado_get_title_tag( true, array(
					'p'    => 'p',
					'span' => esc_html__( 'Custom', 'biagiotti-core' )
				) ),
				'default'   => 'span'
			]
		);

		$this->add_control(
			'tagline_position',
			[
				'label'     => esc_html__( 'Tagline Position', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'top'       => esc_html__( 'Top', 'biagiotti-core' ),
					'bottom'   => esc_html__( 'Bottom', 'biagiotti-core' )
				],
				'default'   => 'top'
			]
		);

		$this->add_control(
			'tagline_color',
			[
				'label'     => esc_html__( 'Tagline Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'tagline_font_size',
			[
				'label'     => esc_html__( 'Tagline Font Size (px)', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'tagline_line_height',
			[
				'label'     => esc_html__( 'Tagline Line Height (px)', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'tagline_font_weight',
			[
				'label'     => esc_html__( 'Tagline Font Weight', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_font_weight_array( true ),
			]
		);

		$this->add_control(
			'tagline_margin',
			[
				'label'     => esc_html__( 'Tagline Bottom Margin (px)', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Style', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'title!' => ''
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   =>  biagiotti_mikado_get_title_tag( true ),
				'default'   => 'h2'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'title_break_words',
			[
				'label'     => esc_html__( 'Position of Line Break', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'biagiotti-core' )
			]
		);


		$this->add_control(
			'disable_break_words',
			[
				'label'     => esc_html__( 'Tagline Position', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_yes_no_select_array( false ),
			]
		);

        $this->end_controls_section();


		$this->start_controls_section(
			'subtitle_settings',
			[
				'label' => esc_html__( 'Subtitle Style', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'subtitle!' => ''
				],
			]
		);

		$this->add_control(
			'subtitle_tag',
			[
				'label'     => esc_html__( 'Subitle Tag', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   =>  biagiotti_mikado_get_title_tag( true ),
				'default'   => 'h5'
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subitle Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'subtitle_font_size',
			[
				'label'     => esc_html__( 'Subtitle Font Size (px)', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'subtitle_line_height',
			[
				'label'     => esc_html__( 'Subtitle Line Height (px)', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'subtitle_font_weight',
			[
				'label'     => esc_html__( 'Subtitle Font Weight', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_font_weight_array( true ),
			]
		);

		$this->add_control(
			'subtitle_margin',
			[
				'label'     => esc_html__( 'Subtitle Top Margin (px)', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();


        $this->start_controls_section(
            'text_settings',
            [
                'label' => esc_html__( 'Text Style', 'biagiotti-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'text!' => ''
                ],
            ]
        );

        $this->add_control(
            'text_tag',
            [
                'label'     => esc_html__( 'Text Tag', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
                'default'   => 'p'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__( 'Text Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'text_font_size',
            [
                'label'     => esc_html__( 'Text Font Size (px)', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'text_line_height',
            [
                'label'     => esc_html__( 'Text Line Height (px)', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'text_font_weight',
            [
                'label'     => esc_html__( 'Text Font Weight', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_font_weight_array( true ),
            ]
        );

        $this->add_control(
            'text_margin',
            [
                'label'     => esc_html__( 'Text Top Margin (px)', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'button_settings',
			[
				'label' => esc_html__( 'Button Style', 'biagiotti-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'button_text!' => ''
				],
			]
		);

		$this->add_control(
			'button_type',
			[
				'label'   => esc_html__( 'Button Type', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'solid'   => esc_html__( 'Solid', 'biagiotti-core' ),
					'outline' => esc_html__( 'Outline', 'biagiotti-core' ),
					'simple'  => esc_html__( 'Simple', 'biagiotti-core' )
				],
				'default'     => 'outline'
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Button Link', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'button_target',
			[
				'label'   => esc_html__( 'Button Link Target', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_link_target_array(),
				'default'     => 'self'
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Button Color', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__( 'Button Hover Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'     => esc_html__( 'Button Background Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid' )
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label'     => esc_html__( 'Button Hover Background Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid', 'outline' )
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'     => esc_html__( 'Button Border Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid', 'outline' )
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Button Hover Border Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid', 'outline' )
				],
			]
		);

		$this->add_control(
			'button_top_margin',
			[
				'label' => esc_html__( 'Button Top Margin (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['tagline_styles']    = $this->getTaglineStyles( $params );
		$params['title']             = $this->getModifiedTitle( $params );
		$params['title_styles']      = $this->getTitleStyles( $params );
		$params['subtitle_styles']   = $this->getSubtitleStyles( $params );
		$params['text_styles']       = $this->getTextStyles( $params );
		$params['image']             = $this->getImage( $params );
		$params['image_styles']      = $this->getImageStyles( $params );
		$params['button_parameters'] = $this->getButtonParameters( $params );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['tagline_position'] ) ? 'mkdf-st-' . $params['tagline_position'] . '-tagline-position' : '';
		$holderClasses[] = ! empty( $params['position'] ) ? 'mkdf-st-' . $params['position'] . '-position' : '';
		$holderClasses[] = ! empty( $params['image_position'] ) ? 'mkdf-st-' . $params['image_position'] . '-image-position' : '';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'mkdf-st-disable-title-break' : '';

		return implode( ' ', $holderClasses );
	}

	private function getHolderStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}

		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}

		return implode( ';', $styles );
	}

	private function getTaglineStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['tagline_color'] ) ) {
			$styles[] = 'color: ' . $params['tagline_color'];
		}

		if ( ! empty( $params['tagline_font_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['tagline_font_size'] ) . 'px';
		}

		if ( ! empty( $params['tagline_line_height'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['tagline_line_height'] ) . 'px';
		}

		if ( ! empty( $params['tagline_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['tagline_font_weight'];
		}

		if ( $params['tagline_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . biagiotti_mikado_filter_px( $params['tagline_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] ?? '' );

		if ( ! empty( $title ) ) {
			$split_title = explode( ' ', $title );

			if ( ! empty( $title_break_words ) ) {
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
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

		return implode( ';', $styles );
	}

	private function getSubtitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}

		if ( ! empty( $params['subtitle_font_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['subtitle_font_size'] ) . 'px';
		}

		if ( ! empty( $params['subtitle_line_height'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['subtitle_line_height'] ) . 'px';
		}

		if ( ! empty( $params['subtitle_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['subtitle_font_weight'];
		}

		if ( $params['subtitle_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['subtitle_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getTextStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}

		if ( ! empty( $params['text_font_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['text_font_size'] ) . 'px';
		}

		if ( ! empty( $params['text_line_height'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['text_line_height'] ) . 'px';
		}

		if ( ! empty( $params['text_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['text_font_weight'];
		}

		if ( $params['text_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['text_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getImage( $params ) {
		$image = array();

		if (  $params['image']['id'] !== '' ) {
			$id = $params['image']['id'];

			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}

		return $image;
	}

	private function getImageStyles( $params ) {
		$styles = array();

		if ( $params['image_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['image_top_margin'] ) . 'px';
		}

		if ( $params['image_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . biagiotti_mikado_filter_px( $params['image_bottom_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getButtonParameters( $params ) {
		$button_params = array();

		if ( ! empty( $params['button_text'] ) ) {
			$button_params['text']   = $params['button_text'];
			$button_params['type']   = $params['button_type'];
			$button_params['link']   = ! empty( $params['button_link'] ) ? $params['button_link'] : '#';
			$button_params['target'] = ! empty( $params['button_target'] ) ? $params['button_target'] : '_self';

			if ( ! empty( $params['button_color'] ) ) {
				$button_params['color'] = $params['button_color'];
			}

			if ( ! empty( $params['button_hover_color'] ) ) {
				$button_params['hover_color'] = $params['button_hover_color'];
			}

			if ( ! empty( $params['button_background_color'] ) ) {
				$button_params['background_color'] = $params['button_background_color'];
			}

			if ( ! empty( $params['button_hover_background_color'] ) ) {
				$button_params['hover_background_color'] = $params['button_hover_background_color'];
			}

			if ( ! empty( $params['button_border_color'] ) ) {
				$button_params['border_color'] = $params['button_border_color'];
			}

			if ( ! empty( $params['button_hover_border_color'] ) ) {
				$button_params['hover_border_color'] = $params['button_hover_border_color'];
			}

			if ( $params['button_top_margin'] !== '' ) {
				$button_params['margin'] = intval( $params['button_top_margin'] ) . 'px 0 0';
			}
		}

		return $button_params;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorSectionTitle() );