<?php

class BiagiottiCoreElementorAccordion extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_accordion';
    }

    public function get_title() {
        return esc_html__( 'Accordion', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-accordions';
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
            'style',
            [
                'label'   => esc_html__( 'Style', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'accordion' => esc_html__( 'Accordion', 'biagiotti-core' ),
                    'toggle'    => esc_html__( 'Toggle', 'biagiotti-core' )
                ],
                'default' => 'accordion'
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'boxed'  => esc_html__( 'Boxed', 'biagiotti-core' ),
                    'simple' => esc_html__( 'Simple', 'biagiotti-core' )
                ],
                'default' => 'boxed'
            ]
        );

        $this->add_control(
            'background_skin',
            [
                'label'     => esc_html__( 'Background Skin', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    ''      => esc_html__( 'Default', 'biagiotti-core' ),
                    'white' => esc_html__( 'White', 'biagiotti-core' )
                ],
                'condition' => [
                    'layout' => array( 'boxed' )
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter accordion section title', 'biagiotti-core' ),
                'default'     => 'Section'
            ]
        );

        $repeater->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Title Tag', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
                'default' => 'h5'
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label'       => esc_html__( 'Text', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control(
            'accordion_tab',
            [
                'label'       => esc_html__( 'Accordion Tabs', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Accordion Tab' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses( $params );
        ?>

        <div class="mkdf-accordion-holder <?php echo esc_attr( $params['holder_classes'] ); ?> clearfix">
            <?php foreach ( $params['accordion_tab'] as $tab ) {

                echo biagiotti_core_get_shortcode_module_template_part( 'templates/elementor-accordion-template', 'accordions', '', $tab );
            } ?>
        </div>
        <?php
    }

    private function getHolderClasses( $params ) {
		$holder_classes = array( 'mkdf-ac-default' );

		$holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holder_classes[] = $params['style'] == 'toggle' ? 'mkdf-toggle' : 'mkdf-accordion';
		$holder_classes[] = ! empty( $params['layout'] ) ? 'mkdf-ac-' . esc_attr( $params['layout'] ) : '';
		$holder_classes[] = ! empty( $params['background_skin'] ) ? 'mkdf-' . esc_attr( $params['background_skin'] ) . '-skin' : '';

		return implode( ' ', $holder_classes );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorAccordion() );