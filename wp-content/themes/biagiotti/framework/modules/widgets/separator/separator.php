<?php

if ( class_exists( 'BiagiottiCoreClassWidget' ) ) {
	class BiagiottiMikadoClassSeparatorWidget extends BiagiottiCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'mkdf_separator_widget',
				esc_html__( 'Biagiotti Separator Widget', 'biagiotti' ),
				array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'biagiotti' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__( 'Type', 'biagiotti' ),
					'options' => array(
						'normal'     => esc_html__( 'Normal', 'biagiotti' ),
						'full-width' => esc_html__( 'Full Width', 'biagiotti' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'position',
					'title'   => esc_html__( 'Position', 'biagiotti' ),
					'options' => array(
						'center' => esc_html__( 'Center', 'biagiotti' ),
						'left'   => esc_html__( 'Left', 'biagiotti' ),
						'right'  => esc_html__( 'Right', 'biagiotti' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'border_style',
					'title'   => esc_html__( 'Style', 'biagiotti' ),
					'options' => array(
						'solid'  => esc_html__( 'Solid', 'biagiotti' ),
						'dashed' => esc_html__( 'Dashed', 'biagiotti' ),
						'dotted' => esc_html__( 'Dotted', 'biagiotti' )
					)
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'biagiotti' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'width',
					'title' => esc_html__( 'Width (px or %)', 'biagiotti' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'thickness',
					'title' => esc_html__( 'Thickness (px)', 'biagiotti' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'top_margin',
					'title' => esc_html__( 'Top Margin (px or %)', 'biagiotti' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'bottom_margin',
					'title' => esc_html__( 'Bottom Margin (px or %)', 'biagiotti' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}
			
			//prepare variables
			$params = '';
			
			//is instance empty?
			if ( is_array( $instance ) && count( $instance ) ) {
				//generate shortcode params
				foreach ( $instance as $key => $value ) {
					$params .= " $key='$value' ";
				}
			}
			
			echo '<div class="widget mkdf-separator-widget">';
			echo do_shortcode( "[mkdf_separator $params]" ); // XSS OK
			echo '</div>';
		}
	}
}