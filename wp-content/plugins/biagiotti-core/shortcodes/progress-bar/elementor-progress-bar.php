<?php

class BiagiottiCoreElementorProgressBar extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_progress_bar';
    }

    public function get_title() {
        return esc_html__( 'Progress Bar', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-progress-bar';
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
            'percent',
            [
                'label'   => esc_html__( 'Percentage', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '100'
            ]
        );

        $this->add_control(
            'percentage_type',
            [
                'label'   => esc_html__( 'Percentage Type', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''         => esc_html__( 'Default', 'biagiotti-core' ),
                    'floating' => esc_html__( 'Floating', 'biagiotti-core' ),
                ],
                'condition' => [
                    'percent!' => ''
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
                'label' => esc_html__( 'Title Tag', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
                'condition' => [
                    'title!' => ''
                ],
                'default' => 'h6'
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
            'color_active',
            [
                'label' => esc_html__( 'Active Color', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'color_inactive',
            [
                'label' => esc_html__( 'Inactive Color', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['title_styles']       = $this->getTitleStyles( $params );
		$params['active_bar_style']   = $this->getActiveColor( $params );
		$params['inactive_bar_style'] = $this->getInactiveColor( $params );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/progress-bar-template', 'progress-bar', '', $params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['percentage_type'] ) ? 'mkdf-pb-percent-' . esc_attr( $params['percentage_type'] ) : '';

		return implode( ' ', $holderClasses );
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		return $styles;
	}

	private function getActiveColor( $params ) {
		$styles = array();

		if ( ! empty( $params['color_active'] ) ) {
			$styles[] = 'background-color: ' . $params['color_active'];
		}

		return $styles;
	}

	private function getInactiveColor( $params ) {
		$styles = array();

		if ( ! empty( $params['color_inactive'] ) ) {
			$styles[] = 'background-color: ' . $params['color_inactive'];
		}

		return $styles;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorProgressBar() );