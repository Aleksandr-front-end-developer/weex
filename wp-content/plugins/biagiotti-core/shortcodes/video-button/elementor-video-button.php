<?php

class BiagiottiCoreElementorVideoButton extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_video_button';
    }

    public function get_title() {
        return esc_html__( 'Video Button', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-video-button';
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
            'video_link',
            [
                'label' => esc_html__( 'Video Link', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'video_image',
            [
                'label'       => esc_html__( 'Video Image', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select image from media library', 'biagiotti-core' )
            ]
        );

        $this->add_control(
			'play_button_color',
			[
				'label' => esc_html__( 'Play Button Color', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'play_button_bg_color',
			[
				'label' => esc_html__( 'Play Button Background Color', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);

        $this->add_control(
            'play_button_size',
            [
                'label' => esc_html__( 'Play Button Size (px)', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

		$this->add_control(
			'play_button_width',
			[
				'label' => esc_html__( 'Play Button Width/Height (px)', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

        $this->add_control(
            'play_button_image',
            [
                'label'       => esc_html__( 'Play Button Custom Image', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'play_button_hover_image',
            [
                'label'       => esc_html__( 'Play Button Custom Hover Image', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'biagiotti-core' )
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        if ( ! empty( $params['video_image'] ) ) {
            $params['video_image'] = $params['video_image']['id'];
        }

        if ( ! empty( $params['play_button_image'] ) ) {
            $params['play_button_image'] = $params['play_button_image']['id'];
        }

        if ( ! empty( $params['play_button_hover_image'] ) ) {
            $params['play_button_hover_image'] = $params['play_button_hover_image']['id'];
        }

		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['play_button_styles'] = $this->getPlayButtonStyles( $params );
		$params['play_icon_styles']   = $this->getPlayIconStyles( $params );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/video-button', 'video-button', '', $params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['video_image'] ) ? 'mkdf-vb-has-img' : '';

		return implode( ' ', $holderClasses );
	}

	private function getPlayButtonStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['play_button_color'] ) ) {
			$styles[] = 'color: ' . $params['play_button_color'];
		}

		if ( ! empty( $params['play_button_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['play_button_size'] ) . 'px';
		}

		if ( ! empty( $params['play_button_width'] ) ) {
			$styles[] = 'line-height: ' . biagiotti_mikado_filter_px( $params['play_button_width'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getPlayIconStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['play_button_bg_color'] ) ) {
			$styles[] = 'background-color: ' . $params['play_button_bg_color'];
		}

		if ( ! empty( $params['play_button_width'] ) ) {
			$styles[] = 'width: ' . biagiotti_mikado_filter_px( $params['play_button_width'] ) . 'px';
			$styles[] = 'height: ' . biagiotti_mikado_filter_px( $params['play_button_width'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorVideoButton() );