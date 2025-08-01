<?php

class BiagiottiCoreElementorIconListItem extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_icon_list_item';
    }

    public function get_title() {
        return esc_html__( 'Icon List Item', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-icon-list-item';
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
            'item_margin',
            [
                'label'       => esc_html__( 'Icon List Item Bottom Margin (px)', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Set bottom margin for your Icon List Item element. Default value is 8', 'biagiotti-core' )
            ]
        );

        biagiotti_mikado_icon_collections()->getElementorParamsArray( $this, '', '' );

        $this->add_control(
            'icon_size',
            [
                'label'       => esc_html__( 'Icon Size (px)', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label'       => esc_html__( 'Title Size (px)', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'title!' => ''
                ],
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
            'title_padding',
            [
                'label'       => esc_html__( 'Title Left Padding (px)', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'title!' => ''
                ],
                'description' => esc_html__( 'Set left padding for your text element to adjust space between icon and text. Default value is 13', 'biagiotti-core' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $iconPackName = biagiotti_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );

		$params['holder_classes']           = $this->getHolderClasses( $params );
		$params['holder_styles']            = $this->getHolderStyles( $params );
		$params['icon']                     = $params[ $iconPackName ];
		$params['icon_attributes']['style'] = $this->getIconStyles( $params );
		$params['title_styles']             = $this->getTitleStyles( $params );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/icon-list-item-template', 'icon-list-item', '', $params );
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		return implode( ' ', $holderClasses );
	}

	private function getHolderStyles( $params ) {
		$styles = array();

		if ( $params['item_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . biagiotti_mikado_filter_px( $params['item_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getIconStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['icon_color'] ) ) {
			$styles[] = 'color: ' . $params['icon_color'];
		}

		if ( ! empty( $params['icon_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['icon_size'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		if ( ! empty( $params['title_size'] ) ) {
			$styles[] = 'font-size: ' . biagiotti_mikado_filter_px( $params['title_size'] ) . 'px';
		}

		if ( $params['title_padding'] !== '' ) {
			$styles[] = 'padding-left: ' . biagiotti_mikado_filter_px( $params['title_padding'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorIconListItem() );