<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BiagiottiInstagramWidget extends WP_Widget {
	protected $params;

	public function __construct() {
		parent::__construct(
			'mkdf_instagram_widget',
			esc_html__( 'Biagiotti Instagram Widget', 'biagiotti-instagram-feed' ),
			array(
				'description' => esc_html__( 'Display your Instagram feed', 'biagiotti-instagram-feed' ),
			)
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'name'  => 'title',
				'type'  => 'textfield',
				'title' => esc_html__( 'Title', 'biagiotti-instagram-feed' ),
			),
			array(
				'name'    => 'type',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Type', 'biagiotti-instagram-feed' ),
				'options' => array(
					'gallery'  => esc_html__( 'Gallery', 'biagiotti-instagram-feed' ),
					'carousel' => esc_html__( 'Carousel', 'biagiotti-instagram-feed' ),
				),
			),
			array(
				'name'    => 'number_of_cols',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Number of Columns', 'biagiotti-instagram-feed' ),
				'options' => array(
					'1' => esc_html__( 'One', 'biagiotti-instagram-feed' ),
					'2' => esc_html__( 'Two', 'biagiotti-instagram-feed' ),
					'3' => esc_html__( 'Three', 'biagiotti-instagram-feed' ),
					'4' => esc_html__( 'Four', 'biagiotti-instagram-feed' ),
					'5' => esc_html__( 'Five', 'biagiotti-instagram-feed' ),
					'6' => esc_html__( 'Six', 'biagiotti-instagram-feed' ),
					'9' => esc_html__( 'Nine', 'biagiotti-instagram-feed' ),
				),
			),
			array(
				'name'  => 'number_of_photos',
				'type'  => 'textfield',
				'title' => esc_html__( 'Number of Photos', 'biagiotti-instagram-feed' ),
			),
			array(
				'name'    => 'space_between_items',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Space Between Items', 'biagiotti-instagram-feed' ),
				'options' => array(
					'medium' => esc_html__( 'Medium (20)', 'biagiotti-instagram-feed' ),
					'normal' => esc_html__( 'Normal (15)', 'biagiotti-instagram-feed' ),
					'small'  => esc_html__( 'Small (10)', 'biagiotti-instagram-feed' ),
					'tiny'   => esc_html__( 'Tiny (5)', 'biagiotti-instagram-feed' ),
					'micro'  => esc_html__( 'Micro (3)', 'biagiotti-instagram-feed' ),
					'no'     => esc_html__( 'No (0)', 'biagiotti-instagram-feed' ),
				),
			),
			array(
				'name'    => 'show_instagram_icon',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Show Instagram Icon', 'biagiotti-instagram-feed' ),
				'options' => biagiotti_mikado_get_yes_no_select_array( false ),
			),
			array(
				'name'    => 'show_instagram_info',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Show Instagram Info', 'biagiotti-instagram-feed' ),
				'options' => biagiotti_mikado_get_yes_no_select_array( false ),
			),
			array(
				'name'  => 'instagram_tagline',
				'type'  => 'textfield',
				'title' => esc_html__( 'Tagline', 'biagiotti-instagram-feed' ),
			),
			array(
				'name'  => 'instagram_title',
				'type'  => 'textfield',
				'title' => esc_html__( 'Title', 'biagiotti-instagram-feed' ),
			),
			array(
				'name'  => 'instagram_subtitle',
				'type'  => 'textfield',
				'title' => esc_html__( 'Subtitle', 'biagiotti-instagram-feed' ),
			),
			array(
				'name'  => 'transient_time',
				'type'  => 'textfield',
				'title' => esc_html__( 'Images Cache Time', 'biagiotti-instagram-feed' ),
			),
		);
	}

	public function getParams() {
		return $this->params;
	}

	public function widget( $args, $instance ) {
		// phpcs:ignore WordPress.PHP.DontExtract.extract_extract
		extract( $instance, EXTR_SKIP );

		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $title ) ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		}

		$number_of_photos = isset( $number_of_photos ) ? $number_of_photos : '6';

		$transient_time = ! empty( $transient_time ) ? $transient_time : '10800';

		$instagram_api = BiagiottiInstagramApi::get_instance();
		$images_array  = $instagram_api->get_images(
			$number_of_photos,
			array(
				'use_transients' => true,
				'transient_name' => $args['widget_id'],
				'transient_time' => $transient_time,
			)
		);

		$type                = ! empty( $type ) ? $type : 'gallery';
		$number_of_cols      = ! empty( $number_of_cols ) ? $number_of_cols : 3;
		$space_between_items = ! empty( $space_between_items ) ? $space_between_items : 'normal';
		$show_instagram_icon = ! empty( $show_instagram_icon ) ? $show_instagram_icon : 'no';
		$show_instagram_info = ! empty( $show_instagram_info ) ? $show_instagram_info : 'no';

		$widget_class = '';
		$slider_data  = array();

		if ( 'carousel' === $type ) {
			$widget_class = 'mkdf-instagram-carousel mkdf-owl-slider';

			$slider_margin = 0;
			if ( 'medium' === $space_between_items ) {
				$slider_margin = 40;
			} elseif ( 'normal' === $space_between_items ) {
				$slider_margin = 30;
			} elseif ( 'small' === $space_between_items ) {
				$slider_margin = 20;
			} elseif ( 'tiny' === $space_between_items ) {
				$slider_margin = 10;
			} elseif ( 'micro' === $space_between_items ) {
				$slider_margin = 6;
			} elseif ( 'no' === $space_between_items ) {
				$slider_margin = 0;
			}

			$slider_data['data-number-of-items']   = esc_attr( $number_of_cols );
			$slider_data['data-slider-margin']     = esc_attr( $slider_margin );
			$slider_data['data-enable-navigation'] = 'no';
			$slider_data['data-enable-pagination'] = 'no';
		} elseif ( 'gallery' === $type ) {
			$widget_class = 'mkdf-instagram-gallery mkdf-' . esc_attr( $space_between_items ) . '-space';
		}

		if ( is_array( $images_array ) && count( $images_array ) ) { ?>
			<ul class="mkdf-instagram-feed clearfix mkdf-col-<?php echo esc_attr( $number_of_cols ); ?> <?php echo esc_attr( $widget_class ); ?>"
				<?php biagiotti_instagram_inline_attrs( $slider_data ); ?>>
				<?php
				foreach ( $images_array as $image ) {
					?>
					<li>
						<a href="<?php echo esc_url( $instagram_api->get_helper()->get_image_link( $image ) ); ?>"
						   target="_blank">
							<?php echo wp_kses_post( $instagram_api->get_helper()->get_image_html( $image ) ); ?>
							<?php if ( 'yes' === $show_instagram_icon ) { ?>
								<span class="mkdf-instagram-icon"><i class="ion-social-instagram-outline"></i></span>
							<?php } ?>
						</a>
					</li>
				<?php } ?>
			</ul>
			<?php
		}

		if ( 'yes' === $show_instagram_info ) {
			?>
			<div class="mkdf-instagram-info">
				<?php if ( ! empty( $instagram_tagline ) ) { ?>
					<div class="mkdf-instagram-tagline"><?php echo esc_html( $instagram_tagline ); ?></div>
				<?php } ?>
				<?php if ( ! empty( $instagram_title ) ) { ?>
					<h2 class="mkdf-instagram-title"><?php echo esc_html( $instagram_title ); ?></h2>
				<?php } ?>
				<?php if ( ! empty( $instagram_subtitle ) ) { ?>
					<div class="mkdf-instagram-subtitle"><?php echo esc_html( $instagram_subtitle ); ?></div>
				<?php } ?>
			</div>
			<?php
		}

		echo wp_kses_post( $args['after_widget'] );
	}

	public function form( $instance ) {
		foreach ( $this->params as $param_array ) {
			$param_name    = $param_array['name'];
			${$param_name} = isset( $instance[ $param_name ] ) ? esc_attr( $instance[ $param_name ] ) : '';
		}

		$instagram_api = BiagiottiInstagramApi::get_instance();

		// user has connected with instagram. Show form.
		if ( $instagram_api->has_user_connected() ) {
			foreach ( $this->params as $param ) {
				if ( 'textfield' === $param['type'] ) {
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo esc_html( $param['title'] ); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"
							   name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" type="text"
							   value="<?php echo esc_attr( ${$param['name']} ); ?>"/>
					</p>
					<?php
				} elseif ( 'dropdown' == $param['type'] ) {
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo esc_html( $param['title'] ); ?></label>
						<?php if ( isset( $param['options'] ) && is_array( $param['options'] ) && count( $param['options'] ) ) { ?>
							<select class="widefat"
									name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>"
									id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>">
								<?php
								foreach ( $param['options'] as $param_option_key => $param_option_val ) {
									$option_selected = '';
									if ( ${$param['name']} == $param_option_key ) {
										$option_selected = 'selected';
									}
									?>
									<option <?php echo esc_attr( $option_selected ); ?>
											value="<?php echo esc_attr( $param_option_key ); ?>"><?php echo esc_attr( $param_option_val ); ?></option>
								<?php } ?>
							</select>
						<?php } ?>
					</p>
					<?php
				}
			}
		}
	}
}

if ( ! function_exists( 'biagiotti_instagram_feed_widget_load' ) ) {
	function biagiotti_instagram_feed_widget_load() {
		if ( biagiotti_instagram_theme_installed() ) {
			register_widget( 'BiagiottiInstagramWidget' );
		}
	}

	add_action( 'widgets_init', 'biagiotti_instagram_feed_widget_load' );
}
