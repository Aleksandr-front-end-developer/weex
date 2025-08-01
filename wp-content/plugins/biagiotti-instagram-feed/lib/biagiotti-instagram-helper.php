<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class BiagiottiInstagramHelper
 */
class BiagiottiInstagramHelper {
	/**
	 * Generates HTML for given image from Instagram feed. Defines biagiotti_instagram_image_atts filter
	 *
	 * @param $image BiagiottiInstagramHelper associative array of image informations
	 *
	 * @return string generated HTML string
	 */
	public function get_image_html( $image ) {
		$atts = '';

		$image_atts = apply_filters(
			'biagiotti_instagram_image_atts',
			array(
				'src' => $this->get_image_src( $image ),
				'alt' => $this->get_image_alt( $image ),
			)
		);

		if ( is_array( $image_atts ) && count( $image_atts ) ) {
			foreach ( $image_atts as $att_name => $att_value ) {
				$atts .= $att_name . '="' . $att_value . '" ';
			}
		}

		return '<img ' . $atts . ' />';
	}

	/**
	 * Returns URL to Instagram image
	 *
	 * @param        $image_arr BiagiottiInstagramHelper associative array of image informations
	 *
	 * @return string URL to Instagram image
	 */
	public function get_image_src( $image_arr ) {

		if ( isset( $image_arr['thumbnail_url'] ) ) {
			return $image_arr['thumbnail_url'];
		} elseif ( isset( $image_arr['media_url'] ) ) {
			return $image_arr['media_url'];
		} else {
			return '';
		}
	}

	/**
	 * Returns image description
	 *
	 * @param $image_arr BiagiottiInstagramHelper associative array of image informations
	 *
	 * @return string image alt text
	 */
	public function get_image_alt( $image_arr ) {

		if ( isset( $image_arr['caption'] ) ) {
			return $image_arr['caption'];
		} else {
			return '';
		}
	}

	/**
	 * Returns a link to instagram image
	 *
	 * @param $image_arr
	 *
	 * @return string
	 */
	public function get_image_link( $image_arr ) {

		if ( isset( $image_arr['permalink'] ) ) {
			return $image_arr['permalink'];
		} else {
			return '';
		}
	}
}
