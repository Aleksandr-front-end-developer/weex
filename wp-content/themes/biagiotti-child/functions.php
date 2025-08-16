<?php
require_once get_stylesheet_directory() . '/widgets/weex-color-filter-widget.php';


define('CHILD_BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR', get_stylesheet_directory() . '/framework/modules');


/*** Child Theme Function  ***/

if (! function_exists('biagiotti_mikado_child_theme_enqueue_scripts')) {
	function biagiotti_mikado_child_theme_enqueue_scripts()
	{
		wp_enqueue_script('biagiotti-mikado-scripts', get_stylesheet_directory_uri() . '/scripts.js', array('jquery'), false, true);
		$parent_style = 'biagiotti-mikado-default-style';
		$modules_style = 'biagiotti-mikado-modules';

		wp_enqueue_style('biagiotti-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style, $modules_style));
	}

	add_action('wp_enqueue_scripts', 'biagiotti_mikado_child_theme_enqueue_scripts');
}


// Реєстрація віджета
function weex_register_widgets()
{
	register_widget('Weex_Color_Filter_Widget');
}
add_action('widgets_init', 'weex_register_widgets');


if (! function_exists('biagiotti_mikado_child_is_plugin_installed')) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param $plugin string
	 *
	 * @return bool
	 */
	function biagiotti_mikado_child_is_plugin_installed($plugin)
	{
		switch ($plugin) {
			case 'core':
				return defined('BIAGIOTTI_CORE_VERSION');
				break;
			case 'woocommerce':
				return function_exists('is_woocommerce');
				break;
			case 'visual-composer':
				return class_exists('WPBakeryVisualComposerAbstract');
				break;
			case 'revolution-slider':
				return class_exists('RevSliderFront');
				break;
			case 'contact-form-7':
				return defined('WPCF7_VERSION');
				break;
			case 'wpml':
				return defined('ICL_SITEPRESS_VERSION');
				break;
			case 'gutenberg-editor':
				return class_exists('WP_Block_Type');
				break;
			case 'gutenberg-plugin':
				return function_exists('is_gutenberg_page') && is_gutenberg_page();
				break;
			default:
				return false;
				break;
		}
	}
}

add_action('enqueue_block_assets', function () {
	if (is_shop() || is_product_category() || is_product_tag()) {
		wp_enqueue_script('wc-price-filter');
		wp_enqueue_script('wc-attribute-filter');
		wp_enqueue_style('wc-blocks-style');
	}
});

add_theme_support('woocommerce');
add_theme_support('woocommerce-block-theme');

include_once get_template_directory() . '/theme-includes.php';
include_once CHILD_BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/sidebar/load.php';
include_once  CHILD_BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/load.php';


// ----- add custom widget area "sort-products" to catalog products -  before sort block products

add_action('woocommerce_before_shop_loop', 'replace_woocommerce_ordering_with_custom_widgets', 25);

function replace_woocommerce_ordering_with_custom_widgets()
{
	if (is_active_sidebar('sort-products')) {
		echo '<div class="sort-products-widgets">';
		dynamic_sidebar('sort-products');
		echo '</div>';
	}
}

// ----- 


//LLM-translates
require_once __DIR__ . '/inc/init-core.php';

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );


if ( ! function_exists( 'get_current_language' ) ) {

  function get_current_language( $value = 'slug' ) {

    if ( function_exists( 'pll_current_language' ) ) {
      return pll_current_language( $value );
    }

    return 'uk';
  }
}

if ( ! function_exists( 'get_language_post' ) ) {

  function get_language_post( $post_id, $slug = '' ) {

    if ( function_exists( 'pll_get_post' ) ) {
      return pll_get_post( $post_id, $slug );
    }

    return $post_id;
  }
}