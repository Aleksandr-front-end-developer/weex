<?php

class BiagiottiCoreElementorCountdown extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_countdown';
    }

    public function get_title() {
        return esc_html__( 'Countdown', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-countdown';
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
            'skin',
            [
                'label'   => esc_html__( 'Skin', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''                 => esc_html__( 'Default', 'biagiotti-core' ),
                    'mkdf-light-skin' => esc_html__( 'Light', 'biagiotti-core' )
                ],
            ]
        );

        $this->add_control(
            'year',
            [
                'label'   => esc_html__( 'Year', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '2019' => esc_html__( '2019', 'biagiotti-core' ),
                    '2020' => esc_html__( '2020', 'biagiotti-core' ),
                    '2021' => esc_html__( '2021', 'biagiotti-core' ),
                    '2022' => esc_html__( '2022', 'biagiotti-core' ),
                    '2023' => esc_html__( '2023', 'biagiotti-core' ),
                    '2024' => esc_html__( '2024', 'biagiotti-core' ),
                    '2025' => esc_html__( '2025', 'biagiotti-core' ),
                ],
            ]
        );

        $this->add_control(
            'month',
            [
                'label'   => esc_html__( 'Month', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1'  => esc_html__( 'January', 'biagiotti-core' ),
                    '2'  => esc_html__( 'February', 'biagiotti-core' ),
                    '3'  => esc_html__( 'March', 'biagiotti-core' ),
                    '4'  => esc_html__( 'April', 'biagiotti-core' ),
                    '5'  => esc_html__( 'May', 'biagiotti-core' ),
                    '6'  => esc_html__( 'June', 'biagiotti-core' ),
                    '7'  => esc_html__( 'July', 'biagiotti-core' ),
                    '8'  => esc_html__( 'August', 'biagiotti-core' ),
                    '9'  => esc_html__( 'September', 'biagiotti-core' ),
                    '10' => esc_html__( 'October', 'biagiotti-core' ),
                    '11' => esc_html__( 'November', 'biagiotti-core' ),
                    '12' => esc_html__( 'December', 'biagiotti-core' ),
                ],
            ]
        );

        $this->add_control(
            'day',
            [
                'label'   => esc_html__( 'Day', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1'  => esc_html__( '1', 'biagiotti-core' ),
                    '2'  => esc_html__( '2', 'biagiotti-core' ),
                    '3'  => esc_html__( '3', 'biagiotti-core' ),
                    '4'  => esc_html__( '4', 'biagiotti-core' ),
                    '5'  => esc_html__( '5', 'biagiotti-core' ),
                    '6'  => esc_html__( '6', 'biagiotti-core' ),
                    '7'  => esc_html__( '7', 'biagiotti-core' ),
                    '8'  => esc_html__( '8', 'biagiotti-core' ),
                    '9'  => esc_html__( '9', 'biagiotti-core' ),
                    '10' => esc_html__( '10', 'biagiotti-core' ),
                    '11' => esc_html__( '11', 'biagiotti-core' ),
                    '12' => esc_html__( '12', 'biagiotti-core' ),
                    '13' => esc_html__( '13', 'biagiotti-core' ),
                    '14' => esc_html__( '14', 'biagiotti-core' ),
                    '15' => esc_html__( '15', 'biagiotti-core' ),
                    '16' => esc_html__( '16', 'biagiotti-core' ),
                    '17' => esc_html__( '17', 'biagiotti-core' ),
                    '18' => esc_html__( '18', 'biagiotti-core' ),
                    '19' => esc_html__( '19', 'biagiotti-core' ),
                    '20' => esc_html__( '20', 'biagiotti-core' ),
                    '21' => esc_html__( '21', 'biagiotti-core' ),
                    '22' => esc_html__( '22', 'biagiotti-core' ),
                    '23' => esc_html__( '23', 'biagiotti-core' ),
                    '24' => esc_html__( '24', 'biagiotti-core' ),
                    '25' => esc_html__( '25', 'biagiotti-core' ),
                    '26' => esc_html__( '26', 'biagiotti-core' ),
                    '27' => esc_html__( '27', 'biagiotti-core' ),
                    '28' => esc_html__( '28', 'biagiotti-core' ),
                    '29' => esc_html__( '29', 'biagiotti-core' ),
                    '30' => esc_html__( '30', 'biagiotti-core' ),
                    '31' => esc_html__( '31', 'biagiotti-core' ),
                ],
            ]
        );

        $this->add_control(
            'hour',
            [
                'label'   => esc_html__( 'Hour', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1'  => esc_html__( '1', 'biagiotti-core' ),
                    '2'  => esc_html__( '2', 'biagiotti-core' ),
                    '3'  => esc_html__( '3', 'biagiotti-core' ),
                    '4'  => esc_html__( '4', 'biagiotti-core' ),
                    '5'  => esc_html__( '5', 'biagiotti-core' ),
                    '6'  => esc_html__( '6', 'biagiotti-core' ),
                    '7'  => esc_html__( '7', 'biagiotti-core' ),
                    '8'  => esc_html__( '8', 'biagiotti-core' ),
                    '9'  => esc_html__( '9', 'biagiotti-core' ),
                    '10' => esc_html__( '10', 'biagiotti-core' ),
                    '11' => esc_html__( '11', 'biagiotti-core' ),
                    '12' => esc_html__( '12', 'biagiotti-core' ),
                    '13' => esc_html__( '13', 'biagiotti-core' ),
                    '14' => esc_html__( '14', 'biagiotti-core' ),
                    '15' => esc_html__( '15', 'biagiotti-core' ),
                    '16' => esc_html__( '16', 'biagiotti-core' ),
                    '17' => esc_html__( '17', 'biagiotti-core' ),
                    '18' => esc_html__( '18', 'biagiotti-core' ),
                    '19' => esc_html__( '19', 'biagiotti-core' ),
                    '20' => esc_html__( '20', 'biagiotti-core' ),
                    '21' => esc_html__( '21', 'biagiotti-core' ),
                    '22' => esc_html__( '22', 'biagiotti-core' ),
                    '23' => esc_html__( '23', 'biagiotti-core' ),
                    '24' => esc_html__( '24', 'biagiotti-core' )
                ],
            ]
        );

        $this->add_control(
            'minute',
            [
                'label'   => esc_html__( 'Minute', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1'  => esc_html__( '1', 'biagiotti-core' ),
                    '2'  => esc_html__( '2', 'biagiotti-core' ),
                    '3'  => esc_html__( '3', 'biagiotti-core' ),
                    '4'  => esc_html__( '4', 'biagiotti-core' ),
                    '5'  => esc_html__( '5', 'biagiotti-core' ),
                    '6'  => esc_html__( '6', 'biagiotti-core' ),
                    '7'  => esc_html__( '7', 'biagiotti-core' ),
                    '8'  => esc_html__( '8', 'biagiotti-core' ),
                    '9'  => esc_html__( '9', 'biagiotti-core' ),
                    '10' => esc_html__( '10', 'biagiotti-core' ),
                    '11' => esc_html__( '11', 'biagiotti-core' ),
                    '12' => esc_html__( '12', 'biagiotti-core' ),
                    '13' => esc_html__( '13', 'biagiotti-core' ),
                    '14' => esc_html__( '14', 'biagiotti-core' ),
                    '15' => esc_html__( '15', 'biagiotti-core' ),
                    '16' => esc_html__( '16', 'biagiotti-core' ),
                    '17' => esc_html__( '17', 'biagiotti-core' ),
                    '18' => esc_html__( '18', 'biagiotti-core' ),
                    '19' => esc_html__( '19', 'biagiotti-core' ),
                    '20' => esc_html__( '20', 'biagiotti-core' ),
                    '21' => esc_html__( '21', 'biagiotti-core' ),
                    '22' => esc_html__( '22', 'biagiotti-core' ),
                    '23' => esc_html__( '23', 'biagiotti-core' ),
                    '24' => esc_html__( '24', 'biagiotti-core' ),
                    '25' => esc_html__( '25', 'biagiotti-core' ),
                    '26' => esc_html__( '26', 'biagiotti-core' ),
                    '27' => esc_html__( '27', 'biagiotti-core' ),
                    '28' => esc_html__( '28', 'biagiotti-core' ),
                    '29' => esc_html__( '29', 'biagiotti-core' ),
                    '30' => esc_html__( '30', 'biagiotti-core' ),
                    '31' => esc_html__( '31', 'biagiotti-core' ),
                    '32' => esc_html__( '32', 'biagiotti-core' ),
                    '33' => esc_html__( '33', 'biagiotti-core' ),
                    '34' => esc_html__( '34', 'biagiotti-core' ),
                    '35' => esc_html__( '35', 'biagiotti-core' ),
                    '36' => esc_html__( '36', 'biagiotti-core' ),
                    '37' => esc_html__( '37', 'biagiotti-core' ),
                    '38' => esc_html__( '38', 'biagiotti-core' ),
                    '39' => esc_html__( '39', 'biagiotti-core' ),
                    '40' => esc_html__( '40', 'biagiotti-core' ),
                    '41' => esc_html__( '41', 'biagiotti-core' ),
                    '42' => esc_html__( '42', 'biagiotti-core' ),
                    '43' => esc_html__( '43', 'biagiotti-core' ),
                    '44' => esc_html__( '44', 'biagiotti-core' ),
                    '45' => esc_html__( '45', 'biagiotti-core' ),
                    '46' => esc_html__( '46', 'biagiotti-core' ),
                    '47' => esc_html__( '47', 'biagiotti-core' ),
                    '48' => esc_html__( '48', 'biagiotti-core' ),
                    '49' => esc_html__( '49', 'biagiotti-core' ),
                    '50' => esc_html__( '50', 'biagiotti-core' ),
                    '51' => esc_html__( '51', 'biagiotti-core' ),
                    '52' => esc_html__( '52', 'biagiotti-core' ),
                    '53' => esc_html__( '53', 'biagiotti-core' ),
                    '54' => esc_html__( '54', 'biagiotti-core' ),
                    '55' => esc_html__( '55', 'biagiotti-core' ),
                    '56' => esc_html__( '56', 'biagiotti-core' ),
                    '57' => esc_html__( '57', 'biagiotti-core' ),
                    '58' => esc_html__( '58', 'biagiotti-core' ),
                    '59' => esc_html__( '59', 'biagiotti-core' ),
                    '60' => esc_html__( '60', 'biagiotti-core' ),
                ]
            ]
        );

        $this->add_control(
            'month_label',
            [
                'label' => esc_html__( 'Month Label', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Month', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'day_label',
            [
                'label' => esc_html__( 'Day Label', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Day', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'hour_label',
            [
                'label' => esc_html__( 'Hour Label', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Hour', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'minute_label',
            [
                'label' => esc_html__( 'Minute Label', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Minute', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'second_label',
            [
                'label' => esc_html__( 'Second Label', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Seconds', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'digit_font_size',
            [
                'label' => esc_html__( 'Digit Font Size (px)', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'label_font_size',
            [
                'label' => esc_html__( 'Label Font Size (px)', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['id']             = mt_rand( 1000, 9999 );
        $params['holder_classes'] = $this->getHolderClasses( $params );
        $params['holder_data']    = $this->getHolderData( $params );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/countdown', 'countdown', '', $params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';

		return implode( ' ', $holderClasses );
	}

	private function getHolderData( $params ) {
		$holderData = array();

		$holderData['data-year']         = ! empty( $params['year'] ) ? $params['year'] : '';
		$holderData['data-month']        = ! empty( $params['month'] ) ? $params['month'] : '';
		$holderData['data-day']          = ! empty( $params['day'] ) ? $params['day'] : '';
		$holderData['data-hour']         = $params['hour'] !== '' ? $params['hour'] : '';
		$holderData['data-minute']       = $params['minute'] !== '' ? $params['minute'] : '';
		$holderData['data-month-label']  = ! empty( $params['month_label'] ) ? $params['month_label'] : esc_html__( 'Months', 'biagiotti-core' );
		$holderData['data-day-label']    = ! empty( $params['day_label'] ) ? $params['day_label'] : esc_html__( 'Days', 'biagiotti-core' );
		$holderData['data-hour-label']   = ! empty( $params['hour_label'] ) ? $params['hour_label'] : esc_html__( 'Hours', 'biagiotti-core' );
		$holderData['data-minute-label'] = ! empty( $params['minute_label'] ) ? $params['minute_label'] : esc_html__( 'Minutes', 'biagiotti-core' );
		$holderData['data-second-label'] = ! empty( $params['second_label'] ) ? $params['second_label'] : esc_html__( 'Seconds', 'biagiotti-core' );
		$holderData['data-digit-size']   = ! empty( $params['digit_font_size'] ) ? $params['digit_font_size'] : '';
		$holderData['data-label-size']   = ! empty( $params['label_font_size'] ) ? $params['label_font_size'] : '';

		return $holderData;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorCountdown() );