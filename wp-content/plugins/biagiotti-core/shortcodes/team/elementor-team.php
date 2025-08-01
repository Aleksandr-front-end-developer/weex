<?php

class BiagiottiCoreElementorTeam extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_team';
    }

    public function get_title() {
        return esc_html__( 'Team', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-team';
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
            'orientation',
            [
                'label'   => esc_html__( 'Orientation', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'left' => esc_html__( 'Left', 'biagiotti-core' ),
                    'right'    => esc_html__( 'Right', 'biagiotti-core' ),
                ],
                'default' => 'left'
            ]
        );

        $this->add_control(
            'team_image',
            [
                'label' => esc_html__( 'Image', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'team_name',
            [
                'label' => esc_html__( 'Name', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'team_name_tag',
            [
                'label'   => esc_html__( 'Name Tag', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_title_tag( true ),
                'default' => 'h2'
            ]
        );

        $this->add_control(
            'team_name_color',
            [
                'label'     => esc_html__( 'Name Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_name!' => ''
                ],
            ]
        );

        $this->add_control(
            'team_position',
            [
                'label' => esc_html__( 'Position', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'team_position_color',
            [
                'label'     => esc_html__( 'Position Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_position!' => ''
                ],
            ]
        );

        $this->add_control(
            'team_text',
            [
                'label' => esc_html__( 'Text', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'team_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_text!' => ''
                ],
            ]
        );

		$this->add_control(
			'team_link',
			[
				'label' => esc_html__( 'Link', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'team_target',
			[
				'label'   => esc_html__( 'Target', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_link_target_array( true ),
				'default' => '_self'
			]
		);

        $repeater = new \Elementor\Repeater();

        biagiotti_mikado_icon_collections()->getElementorParamsArray( $repeater, '', '' );

        $repeater->add_control(
            'team_social_icon_link',
            [
                'label' => esc_html__( 'Social Icon Link', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'team_social_icon_target',
            [
                'label'   => esc_html__( 'Social Icon Target', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_link_target_array()
            ]
        );

        $this->add_control(
            'social_icon',
            [
                'label'       => esc_html__( 'Social Icons', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Social Icon' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        if ( ! empty( $params['team_image'] ) ) {
            $params['team_image'] = $params['team_image']['id'];
        }

		$params['number_of_social_icons'] = 5;
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['team_social_icons']    = $this->getTeamSocialIcons( $params );
		$params['team_name_styles']     = $this->getTeamNameStyles( $params );
		$params['team_position_styles'] = $this->getTeamPositionStyles( $params );
		$params['team_text_styles']     = $this->getTeamTextStyles( $params );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/team', 'team', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

		$holderClasses[] = ! empty( $params['orientation'] ) ? 'mkdf-team-' . $params['orientation'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getTeamSocialIcons( $params ) {

        $team_social_icons = array();

        if ( $params['social_icon'] !== '' ) {

            foreach ( $params['social_icon'] as $icon ) {

                $iconPackName = biagiotti_mikado_icon_collections()->getIconCollectionParamNameByKey( $icon['icon_pack'] );

                $team_icon_params                  = array();
                $team_icon_params['icon_pack']     = $icon['icon_pack'];
                $team_icon_params[ $iconPackName ] = $icon[ $iconPackName ];
                $team_icon_params['link']          = $icon['team_social_icon_link'];
                $team_icon_params['target']        = $icon['team_social_icon_target'];

                $team_social_icons[] = biagiotti_mikado_execute_shortcode( 'mkdf_icon', $team_icon_params );
            }
        }

        return $team_social_icons;
    }

    private function getTeamNameStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['team_name_color'] ) ) {
            $styles[] = 'color: ' . $params['team_name_color'];
        }

        return implode( ';', $styles );
    }

    private function getTeamPositionStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['team_position_color'] ) ) {
            $styles[] = 'color: ' . $params['team_position_color'];
        }

        return implode( ';', $styles );
    }

    private function getTeamTextStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['team_text_color'] ) ) {
            $styles[] = 'color: ' . $params['team_text_color'];
        }

        return implode( ';', $styles );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorTeam() );