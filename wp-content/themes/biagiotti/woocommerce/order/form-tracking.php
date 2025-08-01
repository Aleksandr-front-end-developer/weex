<?php
/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $post;
?>

<p class="mkdf-empty-cart-custom"><?php esc_html_e('perfect shades', 'biagiotti' )?></p>
<h2 class="mkdf-empty-cart-title"><?php esc_html_e('Contact Us', 'biagiotti' )?></h2>
<h5 class="mkdf-empty-cart-text"><?php esc_html_e('At vero eos et accusamus et', 'biagiotti' )?></h5>

<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="woocommerce-form woocommerce-form-track-order track_order">

	<?php
	/**
	 * Action hook fired at the beginning of the form-tracking form.
	 *
	 * @since 7.0.1
	 */
	do_action( 'woocommerce_order_tracking_form_start' );
	?>

    <p><?php esc_html_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'biagiotti' ); ?></p>

	<p class="form-row form-row-first"><label for="orderid"><?php esc_html_e( 'Order ID', 'biagiotti' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php esc_html_e( 'Order ID, found in your order confirmation email.', 'biagiotti' ); ?>" value="<?php echo isset( $_REQUEST['orderid'] ) ? esc_attr( wp_unslash( $_REQUEST['orderid'] ) ) : ''; ?>" /></p><?php // @codingStandardsIgnoreLine ?>
	<p class="form-row form-row-last"><label for="order_email"><?php esc_html_e( 'Billing email', 'biagiotti' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php esc_html_e( 'Billing email, email you used during checkout.', 'biagiotti' ); ?>" value="<?php echo isset( $_REQUEST['order_email'] ) ? esc_attr( wp_unslash( $_REQUEST['order_email'] ) ) : ''; ?>" /></p><?php // @codingStandardsIgnoreLine ?>
	<div class="clear"></div>

	<?php
	/**
	 * Action hook fired in the middle of the form-tracking form (before the submit button).
	 *
	 * @since 7.0.1
	 */
	do_action( 'woocommerce_order_tracking_form' );
	?>

	<p class="form-row"><button type="submit" class="button" name="track" value="<?php esc_attr_e( 'Track', 'biagiotti' ); ?>"><?php esc_html_e( 'Track', 'biagiotti' ); ?></button></p>
	<?php wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' ); ?>

	<?php
	/**
	 * Action hook fired at the end of the form-tracking form (after the submit button).
	 *
	 * @since 7.0.1
	 */
	do_action( 'woocommerce_order_tracking_form_end' );
	?>

</form>
