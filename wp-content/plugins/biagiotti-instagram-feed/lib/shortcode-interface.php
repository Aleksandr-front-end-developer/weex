<?php

namespace BiagiottiInstagram\Lib;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Interface ShortcodeInterface
 *
 * @package BiagiottiInstagram\Lib
 */
interface ShortcodeInterface {
	/**
	 * Returns base for shortcode
	 *
	 * @return string
	 */
	public function get_base();

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vc_map();

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null );
}
