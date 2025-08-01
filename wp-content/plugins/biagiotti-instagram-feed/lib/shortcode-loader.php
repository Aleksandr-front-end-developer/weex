<?php

namespace BiagiottiInstagram\Lib;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class ShortcodeLoader
 *
 * @package InstagramShortcodeLoader\Lib
 */
class ShortcodeLoader {
	/**
	 * Variable
	 *
	 * @var $instance ShortcodeLoader of current class
	 */
	private static $instance;
	/**
	 * Array
	 *
	 * @var array
	 */
	private $loaded_shortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
	}

	/**
	 * Returns current instance of class
	 *
	 * @return ShortcodeLoader
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			return new self();
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 *
	 * @param ShortcodeInterface $shortcode
	 */
	private function add_shortcode( ShortcodeInterface $shortcode ) {
		if ( ! array_key_exists( $shortcode->get_base(), $this->loaded_shortcodes ) ) {
			$this->loaded_shortcodes[ $shortcode->get_base() ] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::add_shortcode()
	 */
	private function add_shortcodes() {
		$shortcodes_class_name = apply_filters( 'biagiotti_instagram_filter_add_vc_shortcode', $shortcodes_class_name = array() );
		sort( $shortcodes_class_name );

		if ( ! empty( $shortcodes_class_name ) ) {
			foreach ( $shortcodes_class_name as $shortcode_class_name ) {
				$this->add_shortcode( new $shortcode_class_name() );
			}
		}
	}

	/**
	 * Calls ShortcodeLoader::add_shortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		if ( biagiotti_instagram_theme_installed() ) {
			$this->add_shortcodes();

			foreach ( $this->loaded_shortcodes as $shortcode ) {
				add_shortcode( $shortcode->get_base(), array( $shortcode, 'render' ) );
			}
		}
	}
}
