<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-reviews.php
 * 
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

defined( 'ABSPATH' ) || exit;

?>
<li>
	<?php do_action( 'woocommerce_widget_product_review_item_start', $args ); ?>

	<div class="mkdf-woo-widget-img">
		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php $image_id = $product->get_image_id();
			echo biagiotti_mikado_generate_thumbnail( $image_id, null, 67, 84 ); ?>
		</a>
	</div>
	<div class="mkdf-woo-widget-content">
		<span class="mkdf-woo-widget-title">
			<a itemprop="url" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
		</span>
		<?php echo wc_get_rating_html( intval( get_comment_meta( $comment->comment_ID, 'rating', true ) ) );?>
		<span class="reviewer"><?php echo sprintf( esc_html__( 'by %s', 'biagiotti' ), get_comment_author( $comment->comment_ID ) ); ?></span>
	</div>

	<?php do_action( 'woocommerce_widget_product_review_item_end', $args ); ?>
</li>
