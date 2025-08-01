<?php

class BiagiottiCoreElementorPricingTable extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_pricing_table';
    }

    public function get_title() {
        return esc_html__( 'Pricing Table', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-pricing-table';
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
            'number_of_columns',
            [
                'label'   => esc_html__( 'Number of Columns', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_number_of_columns_array( true ),
                'default' => 'three'
            ]
        );

        $this->add_control(
            'space_between_items',
            [
                'label'   => esc_html__( 'Space Between Items', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_space_between_items_array(),
                'default' => 'normal'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'custom_class',
            [
                'label'       => esc_html__( 'Custom CSS Class', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'biagiotti-core' )
            ]
        );

        $repeater->add_control(
            'set_active_item',
            [
                'label'       => esc_html__( 'Set Item As Active', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => biagiotti_mikado_get_yes_no_select_array( false ),
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'biagiotti-core' )
            ]
        );

		$repeater->add_control(
			'active_custom_text',
			[
				'label'       => esc_html__( 'Custom Bottom Text', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'set_active_item' => array( 'yes' )
				],
			]
		);

        $repeater->add_control(
            'content_background_color',
            [
                'label' => esc_html__( 'Content Background Color', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Basic Plan'
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'title!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'title_border_color',
            [
                'label'     => esc_html__( 'Title Bottom Border Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'title!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'price',
            [
                'label'   => esc_html__( 'Price', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '100'
            ]
        );

        $repeater->add_control(
            'price_color',
            [
                'label'     => esc_html__( 'Price Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'price!' => ''
                ]
            ]
        );

        $repeater->add_control(
            'currency',
            [
                'label'       => esc_html__( 'Currency', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default mark is $', 'biagiotti-core' ),
                'default'     => '$'
            ]
        );

        $repeater->add_control(
            'currency_color',
            [
                'label'     => esc_html__( 'Currency Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'currency!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'price_period',
            [
                'label'       => esc_html__( 'Price Period', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Default label is monthly', 'biagiotti-core' ),
                'default'     => 'monthly'
            ]
        );

        $repeater->add_control(
            'price_period_color',
            [
                'label'     => esc_html__( 'Price Period Color', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'price_period!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label'   => esc_html__( 'Button Text', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'BUY NOW', 'biagiotti-core' )
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'     => esc_html__( 'Button Link', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'button_text!' => ''
                ],
            ]
        );

		$repeater->add_control(
			'target',
			[
				'label'   => esc_html__( 'Target', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => biagiotti_mikado_get_link_target_array(),
				'default' => '_self'
			]
		);

        $repeater->add_control(
            'button_type',
            [
                'label'       => esc_html__( 'Button Type', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => [
                    'solid'   => esc_html__( 'Solid', 'biagiotti-core' ),
                    'outline' => esc_html__( 'Outline', 'biagiotti-core' ),
                    'simple' => esc_html__( 'Simple', 'biagiotti-core' ),
                ],
                'button_text' => [
                    'button_text!' => ''
                ],
                'default'     => 'outline'
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label'   => esc_html__( 'Content', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<ul><li>' . esc_html__( 'content content content', 'biagiotti-core' ) . '</li><li>' . esc_html__( 'content content content', 'biagiotti-core' ) . '</li><li>' . esc_html__( 'content content content', 'biagiotti-core' ) . '</li></ul>'
            ]
        );

        $this->add_control(
            'pricing_table_item',
            [
                'label'       => esc_html__( 'Pricing Table Items', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Pricing Table Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args = array(
            'number_of_columns'   => 'three',
            'space_between_items' => 'normal'
        );

        $holder_class = $this->getHolderClasses( $params, $args ); ?>

        <div class="mkdf-pricing-tables mkdf-grid-list mkdf-disable-bottom-space clearfix <?php echo esc_attr( $holder_class ) ?>">
            <div class="mkdf-pt-wrapper mkdf-outer-space">

                <?php foreach ( $params['pricing_table_item'] as $pti ) {

                    $pti['holder_classes']          = $this->getItemHolderClasses( $pti );
                    $pti['holder_styles']           = $this->getHolderStyles( $pti );
                    $pti['title_styles']            = $this->getTitleStyles( $pti );
                    $pti['price_styles']            = $this->getPriceStyles( $pti );
                    $pti['currency_styles']         = $this->getCurrencyStyles( $pti );
                    $pti['price_period_styles']     = $this->getPricePeriodStyles( $pti );

                    echo biagiotti_core_get_shortcode_module_template_part( 'templates/pricing-table-template', 'pricing-table', '', $pti );
                } ?>

            </div>
        </div>

        <?php
    }

    private function getHolderClasses( $params, $args ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $args['number_of_columns'] . '-columns';
        $holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';

        return implode( ' ', $holderClasses );
    }

	private function getItemHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['set_active_item'] === 'yes' ? 'mkdf-pt-active-item' : '';

		return implode( ' ', $holderClasses );
	}

	private function getHolderStyles( $params ) {
		$itemStyle = array();

		if ( ! empty( $params['content_background_color'] ) ) {
			$itemStyle[] = 'background-color: ' . $params['content_background_color'];
		}

		return implode( ';', $itemStyle );
	}

	private function getTitleStyles( $params ) {
		$itemStyle = array();

		if ( ! empty( $params['title_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['title_color'];
		}

		if ( ! empty( $params['title_border_color'] ) ) {
			$itemStyle[] = 'border-color: ' . $params['title_border_color'];
		}

		return implode( ';', $itemStyle );
	}

	private function getPriceStyles( $params ) {
		$itemStyle = array();

		if ( ! empty( $params['price_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['price_color'];
		}

		return implode( ';', $itemStyle );
	}

	private function getCurrencyStyles( $params ) {
		$itemStyle = array();

		if ( ! empty( $params['currency_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['currency_color'];
		}

		return implode( ';', $itemStyle );
	}

	private function getPricePeriodStyles( $params ) {
		$itemStyle = array();

		if ( ! empty( $params['price_period_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['price_period_color'];
		}

		return implode( ';', $itemStyle );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorPricingTable() );