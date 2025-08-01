<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>

	<div class="mkdf-woo-widget-img">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<?php $image_id = $product->get_image_id();
			echo biagiotti_mikado_generate_thumbnail( $image_id, null, 67, 84 ); ?>
		</a>
	</div>
	<div class="mkdf-woo-widget-content">
		<span class="mkdf-woo-widget-title">
			<a itemprop="url" href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
		</span>
		<?php if ( ! empty( $show_rating ) ) : ?>
			<?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
		<?php endif; ?>
		<div class="mkdf-woo-widget-price">
			<?php echo biagiotti_mikado_get_module_part( $product->get_price_html() ); ?>
		</div>
	</div>

	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>
