<?php
/**
 * Plugin Name: WooCommerce CRM
 * Plugin URI: https://wooexim.com/woocommerce-crm/
 * Description: Allows for an overview management of customers and their related accounts as well as managing the communication between your store and them.
 * Version: 1.0.0.0
 * Author: WOOEXIM
 * Author URI: https://wooexim.com
 * Tested up to: 5.0.2
 *
 * Text Domain: wc_crm
 * Domain Path: /lang/ 
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * 
 * WC requires at least: 3.4
 * WC tested up to: 3.4.4
 */

if (is_ssl()) {
    define('WOOCRM_PLUGIN_URL', str_replace('http://', 'https://', WP_PLUGIN_URL . '/woocommerce-crm'));
} else {
    define('WOOCRM_PLUGIN_URL', WP_PLUGIN_URL . '/woocommerce-crm');
}

if (!defined('WOOCRM_ASSETS_URL'))
    define('WOOCRM_ASSETS_URL', WOOCRM_PLUGIN_URL . '/assets');

if (!defined('WOOCRM_IMAGES_URL'))
    define('WOOCRM_IMAGES_URL', WOOCRM_ASSETS_URL . '/images');

require_once( 'includes/post-type.php' );
require_once( 'includes/admin-menu.php' );
require_once( 'includes/customer-meta-fields.php' );


// ADMIN STYLES

/**
 * Adds the meta box stylesheet when appropriate
 */
function woocrm_admin_styles(){
	global $typenow;
	
	if( $typenow == 'customers') {
		wp_enqueue_style( 'prfx_meta_box_styles', plugin_dir_url( __FILE__ ) . 'assets/css/meta-box-styles.css' );
	}

	if( isset($_GET['page']) ){
		if( $_GET['page'] == 'woo-crm-emails' || $_GET['page'] == 'woo-crm-accounts' || $_GET['page'] == 'woo-crm-tasks' || $_GET['page'] == 'woo-crm-calls' || $_GET['page'] == 'woo-crm-groups' || $_GET['page'] == 'woo-crm-pro' ) {
			wp_enqueue_style( 'prfx_meta_box_styles', plugin_dir_url( __FILE__ ) . 'assets/css/meta-box-styles.css' );
		}
	}
}
add_action( 'admin_print_styles', 'woocrm_admin_styles' );


/**
 * Loads the color picker javascript
 */
function woocrm_color_enqueue() {
	global $typenow;
	if( $typenow == 'customers' ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'meta-box-color-js', plugin_dir_url( __FILE__ ) . 'assets/js/meta-box-color.js', array( 'wp-color-picker' ) );
	}
}
add_action( 'admin_enqueue_scripts', 'woocrm_color_enqueue' );

/**
 * Loads the image management javascript
 */
function woocrm_image_enqueue() {
	global $typenow;
	if( $typenow == 'customers' ) {
		wp_enqueue_media();
 
		// Registers and enqueues the required javascript.
		wp_register_script( 'meta-box-image', plugin_dir_url( __FILE__ ) . 'assets/js/meta-box-image.js', array( 'jquery' ) );
		wp_localize_script( 'meta-box-image', 'meta_image',
			array(
				'title' => __( 'Choose or Upload an Image', 'wc_crm' ),
				'button' => __( 'Use this image', 'wc_crm' ),
			)
		);
		wp_enqueue_script( 'meta-box-image' );
	}
}
add_action( 'admin_enqueue_scripts', 'woocrm_image_enqueue' );


function woocrm_disable_admin_notices() {
	global $wp_filter;

	if ( is_user_admin() ) {
		if ( isset( $wp_filter['user_admin_notices'] ) ) {
						unset( $wp_filter['user_admin_notices'] );
		}
	} elseif ( isset( $wp_filter['admin_notices'] ) ) {
				unset( $wp_filter['admin_notices'] );
	}
	if ( isset( $wp_filter['all_admin_notices'] ) ) {
				unset( $wp_filter['all_admin_notices'] );
	}
}

add_action( 'admin_print_scripts', 'woocrm_disable_admin_notices' );