<?php
/*
Plugin Name: Biagiotti Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Mikado Themes
Version: 2.3
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BIAGIOTTI_INSTAGRAM_FEED_VERSION', '2.3' );
define( 'BIAGIOTTI_INSTAGRAM_ABS_PATH', __DIR__ );
define( 'BIAGIOTTI_INSTAGRAM_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'BIAGIOTTI_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'BIAGIOTTI_INSTAGRAM_ASSETS_PATH', BIAGIOTTI_INSTAGRAM_ABS_PATH . '/assets' );
define( 'BIAGIOTTI_INSTAGRAM_ASSETS_URL_PATH', BIAGIOTTI_INSTAGRAM_URL_PATH . 'assets' );
define( 'BIAGIOTTI_INSTAGRAM_SHORTCODES_PATH', BIAGIOTTI_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'BIAGIOTTI_INSTAGRAM_SHORTCODES_URL_PATH', BIAGIOTTI_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'biagiotti_instagram_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 *
	 * @return bool
	 */
	function biagiotti_instagram_theme_installed() {
		return defined( 'BIAGIOTTI_MIKADO_ROOT' );
	}
}

if ( ! function_exists( 'biagiotti_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function biagiotti_instagram_feed_text_domain() {
		load_plugin_textdomain( 'biagiotti-instagram-feed', false, BIAGIOTTI_INSTAGRAM_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'biagiotti_instagram_feed_text_domain' );
}
