<?php
$product_image_size = 'woocommerce_thumbnail';

$image_meta            = get_post_meta( get_the_ID(), 'mkdf_woo_product_list_featured_image_meta', true );
$has_featured          = ! empty( $image_meta ) || has_post_thumbnail();
$product_list_image_id = ! empty( $image_meta ) ? biagiotti_mikado_get_attachment_id_from_url( $image_meta ) : '';

if ($has_featured) {
	if ( ! empty( $product_list_image_id ) ) {
		echo wp_get_attachment_image( $product_list_image_id, apply_filters( 'biagiotti_mikado_filter_product_list_image_simple_size', $product_image_size ) );
	} else {
		the_post_thumbnail( apply_filters( 'biagiotti_mikado_filter_product_list_image_simple_size', $product_image_size ) );
	}
}