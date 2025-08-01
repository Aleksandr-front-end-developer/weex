<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
?>
<div class="mkdf-custom-cart-holder">
	<?php do_action( 'woocommerce_cart_is_empty' ); ?>
	<p class="mkdf-empty-cart-custom"><?php esc_html_e('Biagiotti Themes', 'biagiotti' )?></p>
	<h5 class="mkdf-empty-cart-text"><?php esc_html_e('Looks like you haven\'t made your choice yet...', 'biagiotti' )?></h5>
	<?php
	if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
		<p class="return-to-shop">
			<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php esc_html_e( 'Go Back', 'biagiotti' ); ?>
			</a>
		</p>
	<?php endif; ?>
</div>
