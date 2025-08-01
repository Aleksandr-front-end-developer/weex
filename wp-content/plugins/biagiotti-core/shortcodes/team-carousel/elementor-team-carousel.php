<?php

class BiagiottiCoreElementorTeamCarousel extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_team_carousel';
    }

    public function get_title() {
        return esc_html__( 'Team Carousel', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-team-carousel';
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
            'slider_loop',
            [
                'label'   => esc_html__( 'Enable Slider Loop', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Enable Slider Autoplay', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'       => esc_html__( 'Slide Duration', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default value is 5000 (ms)', 'biagiotti-core' ),
                'default'     => '5000'
            ]
        );

        $this->add_control(
            'slider_speed_animation',
            [
                'label'       => esc_html__( 'Slide Animation Duration', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'biagiotti-core' ),
                'default'     => '600'
            ]
        );

        $this->add_control(
            'slider_navigation',
            [
                'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'slider_pagination',
            [
                'label'   => esc_html__( 'Enable Slider Pagination', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_yes_no_select_array( false, true ),
                'default' => 'yes'
            ]
        );


        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
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

        $repeater->add_control(
            'team_image',
            [
                'label' => esc_html__( 'Image', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'team_name',
            [
                'label' => esc_html__( 'Name', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'team_name_tag',
            [
                'label'   => esc_html__( 'Name Tag', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_title_tag( true ),
                'default' => 'h2'
            ]
        );

        $repeater->add_control(
            'team_name_color',
            [
                'label'     => esc_html__( 'Name Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_title_tag( true ),
                'condition' => [
                    'team_name!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'team_position',
            [
                'label' => esc_html__( 'Position', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'team_position_color',
            [
                'label'     => esc_html__( 'Position Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_position!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'team_text',
            [
                'label' => esc_html__( 'Text', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'team_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'team_text!' => ''
                ],
            ]
        );

		$repeater->add_control(
			'team_link',
			[
				'label' => esc_html__( 'Link', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'team_target',
			[
				'label'   => esc_html__( 'Target', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_link_target_array( true ),
				'default' => '_self'
			]
		);

        $this->add_control(
            'team_item',
            [
                'label'       => esc_html__( 'Team Items', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Team Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $slider_data    = $this->getSliderData( $params );
        ?>

        <div class="mkdf-team-carousel-holder">
            <div class="mkdf-tc-inner mkdf-owl-slider" <?php echo biagiotti_mikado_get_inline_attrs( $slider_data ) ?>>
                <?php foreach ( $params['team_item'] as $team ) {
                    if ( ! empty( $team['team_image'] ) ) {
                        $team['team_image'] = $team['team_image']['id'];
                    }

                    $team['holder_classes']         = $this->getHolderClasses( $team );
                    $team['team_name_tag']          = ! empty( $team['team_name_tag'] ) ? $team['team_name_tag'] : 'h6';
//                  $team['team_social_icons']      = $this->getTeamSocialIcons( $params );
                    $team['team_social_icons']      = '';
                    $team['team_name_styles']       = $this->getTeamNameStyles( $team );
                    $team['team_position_styles']   = $this->getTeamPositionStyles( $team );
                    $team['team_text_styles']       = $this->getTeamTextStyles( $team );

                    echo biagiotti_core_get_shortcode_module_template_part( 'templates/team', 'team', '', $team );
                } ?>
            </div>
        </div>
        <?php
    }

	private function getSliderData( $params ) {
		$slider_data = array();

		$slider_data['data-number-of-items']        = '1';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

		return $slider_data;
	}

    private function getHolderClasses( $params ) {
        $holderClasses = array();

		$holderClasses[] = ! empty( $params['orientation'] ) ? 'mkdf-team-' . $params['orientation'] : '';

        return implode( ' ', $holderClasses );
    }

/*    private function getTeamSocialIcons( $params ) {

        $team_social_icons = array();

        if ( $params['social_icon'] !== '' ) {

            foreach ( $params['social_icon'] as $icon ) {

                $iconPackName = biagiotti_mikado_icon_collections()->getIconCollectionParamNameByKey( $icon['icon_pack'] );

                $team_icon_params                  = array();
                $team_icon_params['icon_pack']     = $icon['icon_pack'];
                $team_icon_params[ $iconPackName ] = $icon[ $iconPackName ];
                $team_icon_params['icon_color']    = $icon['team_social_icon_color'];
                $team_icon_params['link']          = $icon['team_social_icon_link'];
                $team_icon_params['target']        = $icon['team_social_icon_target'];

                $team_social_icons[] = biagiotti_mikado_execute_shortcode( 'mkdf_icon', $team_icon_params );
            }
        }

        return $team_social_icons;
    }*/

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

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorTeamCarousel() );