<?php
$product = biagiotti_mikado_return_woocommerce_global_variable();

if ( $product->is_on_sale() ) { ?>
	<span class="mkdf-<?php echo esc_attr( $class_name ); ?>-onsale"><?php echo biagiotti_mikado_get_woocommerce_sale( $product ); ?></span>
<?php } ?>

<?php if ( ! $product->is_in_stock() ) {
    if ( 'yes' !== get_option( 'woocommerce_hide_out_of_stock_items' ) ) { ?>
	<span class="mkdf-<?php echo esc_attr( $class_name ); ?>-out-of-stock"><?php esc_html_e( 'Sold', 'biagiotti' ); ?></span>
<?php }
}

$new = get_post_meta( get_the_ID(), 'mkdf_show_new_sign_woo_meta', true );

if ( $new === 'yes' ) { ?>
	<span class="mkdf-<?php echo esc_attr( $class_name ); ?>-new-product"><?php esc_html_e( 'New', 'biagiotti' ); ?></span>
<?php }

$product_image_size = 'woocommerce_single';
if ( $image_size === 'full' ) {
	$product_image_size = 'full';
} else if ( $image_size === 'square' ) {
	$product_image_size = 'biagiotti_mikado_image_square';
} else if ( $image_size === 'landscape' ) {
	$product_image_size = 'biagiotti_mikado_image_landscape';
} else if ( $image_size === 'portrait' ) {
	$product_image_size = 'biagiotti_mikado_image_portrait';
} else if ( $image_size === 'medium' ) {
	$product_image_size = 'medium';
} else if ( $image_size === 'large' ) {
	$product_image_size = 'large';
} else if ( $image_size === 'woocommerce_thumbnail' ) {
	$product_image_size = 'woocommerce_thumbnail';
}

$fixed_image_size_meta = get_post_meta( get_the_ID(), 'mkdf_product_featured_image_size', true );
if ( ! empty( $fixed_image_size_meta ) && isset( $type ) && $type === 'masonry' ) {
	if ( $fixed_image_size_meta === 'small' ) {
		$product_image_size = 'biagiotti_mikado_image_square';
	} else if ( $fixed_image_size_meta === 'large-width' ) {
		$product_image_size = 'biagiotti_mikado_image_landscape';
	} else if ( $fixed_image_size_meta === 'large-height' ) {
		$product_image_size = 'biagiotti_mikado_image_portrait';
	} else if ( $fixed_image_size_meta === 'large-width-height' ) {
		$product_image_size = 'biagiotti_mikado_image_huge';
	}
}

$image_meta            = get_post_meta( get_the_ID(), 'mkdf_woo_product_list_featured_image_meta', true );
$has_featured          = ! empty( $image_meta ) || has_post_thumbnail();
$product_list_image_id = ! empty( $image_meta ) ? biagiotti_mikado_get_attachment_id_from_url( $image_meta ) : '';

if ($has_featured) {
	if ( ! empty( $product_list_image_id ) ) {
		echo wp_get_attachment_image( $product_list_image_id, apply_filters( 'biagiotti_mikado_filter_product_list_image_size', $product_image_size ) );
	} else {
		the_post_thumbnail( apply_filters( 'biagiotti_mikado_filter_product_list_image_size', $product_image_size ) );
	}
}