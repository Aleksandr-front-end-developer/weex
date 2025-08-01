<?php

class BiagiottiCoreElementorClientsGrid extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_clients_grid';
    }

    public function get_title() {
        return esc_html__( 'Clients Grid', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-clients-grid';
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

        $this->add_control(
            'image_alignment',
            [
                'label'   => esc_html__( 'Items Horizontal Alignment', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''      => esc_html__( 'Default Center', 'biagiotti-core' ),
                    'left'  => esc_html__( 'Left', 'biagiotti-core' ),
                    'right' => esc_html__( 'Right', 'biagiotti-core' ),
                ]
            ]
        );

        $this->add_control(
            'items_hover_animation',
            [
                'label'   => esc_html__( 'Items Hover Animation', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'switch-images' => esc_html__( 'Switch Images', 'biagiotti-core' ),
                    'roll-over'     => esc_html__( 'Roll Over', 'biagiotti-core' )
                ],
                'default' => 'no-animation'
            ]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'       => esc_html__( 'Image', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library', 'biagiotti-core' )
			]
		);

        $repeater->add_control(
            'hover_image',
            [
                'label'       => esc_html__( 'Hover Image', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Select image from media library', 'biagiotti-core' )
            ]
        );

        $repeater->add_control(
            'image_size',
            [
                'label'       => esc_html__( 'Image Size', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'biagiotti-core' ),
                'default'     => 'full'
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Custom Link', 'biagiotti-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'target',
            [
                'label'   => esc_html__( 'Custom Link Target', 'biagiotti-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => biagiotti_mikado_get_link_target_array(),
                'default' => '_self'
            ]
        );

        $this->add_control(
            'clients_item',
            [
                'label'       => esc_html__( 'Client Items', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Client Item' ),
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses( $params );
        ?>

        <div class="mkdf-clients-grid-holder mkdf-grid-list mkdf-disable-bottom-space <?php echo esc_attr( $params['holder_classes'] ); ?>">
            <div class="mkdf-cg-inner mkdf-outer-space">
                <?php foreach ( $params['clients_item'] as $client ) {

                    $client['item_classes'] = $this->getItemClasses( $client );
                    $client['image']        = $this->getCarouselImage( $client );
                    $client['hover_image']  = $this->getCarouselHoverImage( $client );

                    echo biagiotti_core_get_shortcode_module_template_part( 'templates/elementor-clients-grid-item', 'clients-grid', '', $client );
                } ?>
            </div>
        </div>

        <?php
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = 'mkdf-' . $params['number_of_columns'] . '-columns';
		$holderClasses[] = 'mkdf-' . $params['space_between_items'] . '-space';
		$holderClasses[] = 'mkdf-cg-alignment-' . $params['image_alignment'];
		$holderClasses[] = 'mkdf-cc-hover-' . $params['items_hover_animation'];

		return implode( ' ', $holderClasses );
	}

	private function getItemClasses( $client ) {
		$itemClasses = array();

		$itemClasses[] = ! empty( $client['link'] ) ? 'mkdf-cci-has-link' : 'mkdf-cci-no-link';

		return implode( ' ', $itemClasses );
	}

	private function getCarouselImage( $client ) {
		$image_meta = array();

		$client['image'] = $client['image']['id'];

		if ( ! empty( $client['image'] ) ) {
			$image_size     = $this->getCarouselImageSize( $client['image_size'] );
			$image_id       = $client['image'];
			$image_original = wp_get_attachment_image_src( $image_id, $image_size );
			$image['url']   = $image_original[0];
			$image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

			$image_meta = $image;
		}

		return $image_meta;
	}

	private function getCarouselHoverImage( $client ) {
		$image_meta = array();

		$client['hover_image'] = $client['hover_image']['id'];

		if ( ! empty( $client['hover_image'] ) ) {
			$image_size     = $this->getCarouselImageSize( $client['image_size'] );
			$image_id       = $client['hover_image'];
			$image_original = wp_get_attachment_image_src( $image_id, $image_size );
			$image['url']   = $image_original[0];
			$image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

			$image_meta = $image;
		}

		return $image_meta;
	}

	private function getCarouselImageSize( $image_size ) {
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
			return 'full';
		}
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorClientsGrid() );