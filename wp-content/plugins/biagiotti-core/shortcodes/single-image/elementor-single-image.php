<?php

class BiagiottiCoreElementorSingleImage extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_single_image';
    }

    public function get_title() {
        return esc_html__( 'Single Image', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-single-image';
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
                    ''            => esc_html__( 'None', 'biagiotti-core' ),
                    'lightbox'    => esc_html__( 'Open Lightbox', 'biagiotti-core' ),
                    'custom-link' => esc_html__( 'Open Custom Link', 'biagiotti-core' ),
                    'zoom'        => esc_html__( 'Zoom', 'biagiotti-core' ),
                    'grayscale'   => esc_html__( 'Grayscale', 'biagiotti-core' ),
                    'moving'      => esc_html__( 'Moving on Hover', 'biagiotti-core' ),
                ],
				'default' => ''
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
				'default' => '_self'
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
		$params['holder_styles']      = $this->getHolderStyles( $params );
		$params['image']              = $this->getImage( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );

        echo biagiotti_core_get_shortcode_module_template_part( 'templates/single-image', 'single-image', '', $params );
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';
        $holderClasses[] = ! empty( $params['image_behavior'] ) ? 'mkdf-image-behavior-' . $params['image_behavior'] : '';

        return implode( ' ', $holderClasses );
    }

    private function getHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['image'] ) && $params['image_behavior'] === 'moving' ) {
            $image_original = wp_get_attachment_image_src( $params['image'], 'full' );

            $styles[] = 'background-image: url(' . $image_original[0] . ')';
        }

        return implode( ';', $styles );
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
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorSingleImage() );