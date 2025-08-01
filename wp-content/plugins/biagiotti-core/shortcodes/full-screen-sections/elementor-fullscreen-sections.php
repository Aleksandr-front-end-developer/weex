<?php

class BiagiottiCoreElementorFullscreenSections extends \Elementor\Widget_Base{
    public function get_name() {
        return 'mkdf_full_screen_sections';
    }

    public function get_title() {
        return esc_html__( 'Fullscreen Sections', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-full-screen-sections';
    }

    public function get_categories() {
        return [ 'mikado' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'biagiotti-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'enable_navigation',
			[
				'label'       => esc_html__( 'Enable Navigation Arrows', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => biagiotti_mikado_get_yes_no_select_array( false ),
				'default'     => 'yes'
			]
		);

		$this->add_control(
			'enable_pagination',
			[
				'label'       => esc_html__( 'Enable Pagination Dots', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => biagiotti_mikado_get_yes_no_select_array( false ),
				'default'     => 'yes'
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
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'biagiotti-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);

		$repeater->add_control(
			'background_image',
			[
				'label'       => esc_html__( 'Background Image', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA
			]
		);

		$repeater->add_control(
			'background_position',
			[
				'label'       => esc_html__( 'Background Image Position', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert position in format horizontal vertical position, example - center center', 'biagiotti-core' ),
				'condition' => [
					'background_image!' => ''
				],
			]
		);

		$repeater->add_control(
			'background_size',
			[
				'label'   => esc_html__( 'Background Image Size', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'cover'  => esc_html__( 'Cover', 'biagiotti-core' ),
					'contain' => esc_html__( 'Contain', 'biagiotti-core' ),
					'inherit' => esc_html__( 'Inherit', 'biagiotti-core' ),
				],
				'condition' => [
					'background_image!' => ''
				],
			]
		);

		$repeater->add_control(
			'padding',
			[
				'label'       => esc_html__( 'Content Padding', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert padding in format top right bottom left. You can use px or %', 'biagiotti-core' ),
			]
		);

		$repeater->add_control(
			'vertical_alignment',
			[
				'label'   => esc_html__( 'Content Vertical Alignment', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''  => esc_html__( 'Default', 'biagiotti-core' ),
					'top' => esc_html__( 'Top', 'biagiotti-core' ),
					'middle' => esc_html__( 'Middle', 'biagiotti-core' ),
					'bottom' => esc_html__( 'Bottom', 'biagiotti-core' ),
				],
			]
		);

		$repeater->add_control(
			'horizontal_alignment',
			[
				'label'   => esc_html__( 'Content Horizontal Alignment', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''  => esc_html__( 'Default', 'biagiotti-core' ),
					'left' => esc_html__( 'Left', 'biagiotti-core' ),
					'center' => esc_html__( 'Center', 'biagiotti-core' ),
					'right' => esc_html__( 'Right', 'biagiotti-core' ),
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Set custom link around item', 'biagiotti-core' ),
			]
		);

		$repeater->add_control(
			'target',
			[
				'label'     => esc_html__( 'Link Target', 'biagiotti-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => biagiotti_mikado_get_link_target_array(),
				'condition' => [
					'link!' => ''
				],
			]
		);

		$repeater->add_control(
			'header_skin',
			[
				'label'   => esc_html__( 'Header and Navigation Skin', 'biagiotti-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''  => esc_html__( 'Default', 'biagiotti-core' ),
					'light' => esc_html__( 'Light', 'biagiotti-core' ),
					'dark' => esc_html__( 'Dark', 'biagiotti-core' )
				],
				'description' => esc_html__( 'Choose a predefined header style for header elements and for full screen sections navigation/pagination', 'biagiotti-core' ),
			]
		);

		$repeater->add_control(
			'image_laptop',
			[
				'label'       => esc_html__( 'Background Image for Laptops', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA
			]
		);

		$repeater->add_control(
			'image_tablet',
			[
				'label'       => esc_html__( 'Background Image for Tablets - Landscape', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA
			]
		);

		$repeater->add_control(
			'image_tablet_portrait',
			[
				'label'       => esc_html__( 'Background Image for Tablets - Portrait', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA
			]
		);

		$repeater->add_control(
			'image_mobile',
			[
				'label'       => esc_html__( 'Background Image for Mobiles', 'biagiotti-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA
			]
		);

		biagiotti_core_generate_elementor_templates_control( $repeater );

        $this->add_control(
            'fullscreen_section_items',
            [
                'label' => esc_html__( 'Fullscreen Section Items', 'biagiotti-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Fullscreen Section Item'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_data']    = $this->getHolderData( $params );

		?>

        <div class="mkdf-full-screen-sections <?php echo esc_attr( $params['holder_classes'] ); ?>" <?php echo biagiotti_mikado_get_inline_attrs( $params['holder_data'] ); ?>>
            <div class="mkdf-fss-wrapper">
				<?php foreach ( $params['fullscreen_section_items'] as $fullscreen_section_item ) {

					$rand_class = 'mkdf-fss-custom-' . mt_rand(100000,1000000);
					$fullscreen_section_item['item_unique_class'] = $rand_class;
					$fullscreen_section_item['item_classes']      = $this->getItemHolderClasses( $fullscreen_section_item );
					$fullscreen_section_item['item_data']         = $this->geItemtHolderData( $fullscreen_section_item );
					$fullscreen_section_item['item_styles']       = $this->getItemHolderStyles( $fullscreen_section_item );
					$fullscreen_section_item['item_inner_styles']   = $this->getItemInnerStyles( $fullscreen_section_item );
					$fullscreen_section_item['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($fullscreen_section_item['template_id']);

					echo biagiotti_core_get_shortcode_module_template_part('templates/elementor-full-screen-sections-item', 'full-screen-sections', '', $fullscreen_section_item);
				} ?>
            </div>
			<?php if ( $params['enable_navigation'] === 'yes' ) { ?>
                <div class="mkdf-fss-nav-holder">
                    <a id="mkdf-fss-nav-up" href="#"><span class='icon-arrows-up'></span></a>
                    <a id="mkdf-fss-nav-down" href="#"><span class='icon-arrows-down'></span></a>
                </div>
			<?php } ?>
        </div>

        <?php
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = $params['enable_navigation'] === 'yes' ? 'mkdf-fss-has-nav' : '';

		return implode( ' ', $holderClasses );
	}

	private function getHolderData( $params ) {
		$data = array();

		if ( ! empty( $params['enable_navigation'] ) ) {
			$data['data-enable-navigation'] = $params['enable_navigation'];
		}

		if ( ! empty( $params['enable_pagination'] ) ) {
			$data['data-enable-pagination'] = $params['enable_pagination'];
		}

		return $data;
	}

	private function getItemHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['item_unique_class'] ) ? $params['item_unique_class'] : '';
		$holderClasses[] = ! empty( $params['vertical_alignment'] ) ? 'mkdf-fss-item-va-' . $params['vertical_alignment'] : '';
		$holderClasses[] = ! empty( $params['horizontal_alignment'] ) ? 'mkdf-fss-item-ha-' . $params['horizontal_alignment'] : '';
		$holderClasses[] = ! empty( $params['link'] ) ? 'mkdf-fss-item-has-link' : '';
		$holderClasses[] = ! empty( $params['header_skin'] ) ? 'mkdf-fss-item-has-style' : '';

		return implode( ' ', $holderClasses );
	}

	private function geItemtHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['item_unique_class'];

		if ( ! empty( $params['header_skin'] ) ) {
			$data['data-header-style'] = $params['header_skin'];
		}

		if ( ! empty( $params['image_laptop'] ) ) {
			$image                     = wp_get_attachment_image_src( $params['image_laptop'], 'full' );
			if($image){
				$data['data-laptop-image'] = $image[0];
            }
		}

		if ( ! empty( $params['image_tablet'] ) ) {
			$image                     = wp_get_attachment_image_src( $params['image_tablet'], 'full' );
			if($image){
				$data['data-tablet-image'] = $image[0];
            }
		}

		if ( ! empty( $params['image_tablet_portrait'] ) ) {
			$image                              = wp_get_attachment_image_src( $params['image_tablet_portrait'], 'full' );
			if($image){
				$data['data-tablet-portrait-image'] = $image[0];
			}
		}

		if ( ! empty( $params['image_mobile'] ) ) {
			$image                     = wp_get_attachment_image_src( $params['image_mobile'], 'full' );
			if($image){
				$data['data-mobile-image'] = $image[0];
			}
		}

		return $data;
	}

	private function getItemHolderStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}

		if ( ! empty( $params['background_image'] ) ) {
			$styles[] = 'background-image: url(' . wp_get_attachment_url( $params['background_image'] ) . ')';

			if ( ! empty( $params['background_position'] ) ) {
				$styles[] = 'background-position:' . $params['background_position'];
			}

			if ( ! empty( $params['background_size'] ) ) {
				$styles[] = 'background-size:' . $params['background_size'];
			}
		}

		return implode( ';', $styles );
	}

	private function getItemInnerStyles( $params ) {
		$styles = array();

		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}

		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorFullscreenSections() );