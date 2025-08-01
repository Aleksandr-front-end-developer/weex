<?php

class BiagiottiCoreElementorImageWithText extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_image_with_text';
    }

    public function get_title() {
        return esc_html__( 'Image With Text', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-image-with-text';
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
            'image_size',
            [
                'label'       => esc_html__( 'Image Size', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'biagiotti-core' ),
                'default'     => 'full'
            ]

        );

        $this->add_control(
            'enable_image_shadow',
            [
                'label'   => esc_html__( 'Enable Image Shadow', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false ),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'image_behavior',
            [
                'label'   => esc_html__( 'Image Behavior', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''                  => esc_html__( 'None', 'biagiotti-core' ),
                    'lightbox'          => esc_html__( 'Open Lightbox', 'biagiotti-core' ),
                    'custom-link'       => esc_html__( 'Open Custom Link', 'biagiotti-core' ),
                    'two-links-overlay' => esc_html__( 'Two Links Overlay'),
                    'zoom'              => esc_html__( 'Zoom', 'biagiotti-core' ),
                    'grayscale'         => esc_html__( 'Grayscale', 'biagiotti-core' ),
                ],
            ]
        );

        $this->add_control(
            'custom_link',
            [
                'label'     => esc_html__( 'Custom Link', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'image_behavior' => array( 'custom-link' )
                ],
            ]
        );

        $this->add_control(
            'custom_link_target',
            [
                'label'     => esc_html__( 'Custom Link Target', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_link_target_array(),
                'condition' => [
                    'image_behavior' => array( 'custom-link' )
                ],
				'default'	=> '_self'
            ]
        );

		$this->add_control(
			'image_link_text1',
			[
				'label'     => esc_html__( 'Image Link Text 1', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'image_behavior' => array( '' )
				],
			]
		);

		$this->add_control(
			'image_link1',
			[
				'label'     => esc_html__( 'Image Link URL 1', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'image_link_text1!' => '',
					'image_behavior' => array( '' )
				],
			]
		);

		$this->add_control(
			'image_link_target1',
			[
				'label'     => esc_html__( 'Image Link Target 1', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_link_target_array(),
				'condition' => [
					'image_link_text1!' => '',
					'image_behavior' => array( '' )
				],
				'default'	=> '_self'
			]
		);

		$this->add_control(
			'image_link_text2',
			[
				'label'     => esc_html__( 'Image Link Text 2', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'image_behavior' => array( '' )
				],
			]
		);

		$this->add_control(
			'image_link2',
			[
				'label'     => esc_html__( 'Image Link URL 2', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'image_link_text2!' => '',
					'image_behavior' => array( '' )
				],
			]
		);

		$this->add_control(
			'image_link_target2',
			[
				'label'     => esc_html__( 'Image Link Target 2', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_link_target_array(),
				'condition' => [
					'image_link_text2!' => '',
					'image_behavior' => array( '' )
				],
				'default'	=> '_self'
			]
		);

		$this->add_control(
			'image_link_background_color',
			[
				'label'     => esc_html__( 'Image Link Background Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'image_behavior' => array( '' )
				],
				'default'	=> '#ffeeec'
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
			'tagline_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_title_tag( true, array( 'span' => esc_html__( 'Custom Heading' ) ) ),
				'condition' => [
					'tagline!' => ''
				],
				'default'   => 'span'
			]
		);

		$this->add_control(
			'tagline_color',
			[
				'label'     => esc_html__( 'Tagline Color', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'tagline!' => ''
				],
			]
		);

		$this->add_control(
			'tagline_top_margin',
			[
				'label'     => esc_html__( 'Tagline Top Margin (px)', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'tagline!' => ''
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
                'options'   => biagiotti_mikado_get_title_tag( true ),
                'condition' => [
                    'title!' => ''
                ],
                'default'   => 'h6'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'title!' => ''
                ],
            ]
        );

        $this->add_control(
            'title_top_margin',
            [
                'label'     => esc_html__( 'Title Top Margin (px)', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'title!' => ''
                ],
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
            'text_color',
            [
                'label'     => esc_html__( 'Text Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'text!' => ''
                ],
            ]
        );

        $this->add_control(
            'text_top_margin',
            [
                'label'     => esc_html__( 'Text Top Margin (px)', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'text!' => ''
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        if ( ! empty( $params['image'] ) ) {
            $params['image'] = $params['image']['id'];
        }

		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['image']              = $this->getImage( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : '';
		$params['image_links_holder_styles']     = $this->getImageLinksHolderStyle($params);
		$params['tagline_styles']     = $this->getTaglineStyles( $params );
		$params['title_styles']       = $this->getTitleStyles( $params );
		$params['text_styles']        = $this->getTextStyles( $params );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/image-with-text', 'image-with-text', '', $params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';
		$holderClasses[] = ! empty( $params['image_behavior'] ) ? 'mkdf-image-behavior-' . $params['image_behavior'] : '';

		return implode( ' ', $holderClasses );
	}

	private function getImage( $params ) {
		$image = array();

		if ( ! empty( $params['image'] ) ) {
			$id = $params['image'];

			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}

		return $image;
	}

	private function getImageSize( $image_size ) {
		$image_size = trim( $image_size );
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}

	private function getTaglineStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['tagline_color'] ) ) {
			$styles[] = 'color: ' . $params['tagline_color'];
		}

		if ( $params['tagline_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . biagiotti_mikado_filter_px( $params['tagline_top_margin'] ) . 'px';
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

	private function getImageLinksHolderStyle( $params ) {
		$styles = array();

		if ( ! empty( $params['image_link_background_color'] ) ) {
			$styles[] = 'background-image: linear-gradient( #fff, ' . $params['image_link_background_color'] . ')';
		}

		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorImageWithText() );