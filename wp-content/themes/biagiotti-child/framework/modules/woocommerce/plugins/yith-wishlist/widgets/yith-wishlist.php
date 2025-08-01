<?php

class BiagiottiCoreClassYithWishlist extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'mkdf_woocommerce_yith_wishlist',
			esc_html__('Biagiotti Woocommerce Wishlist', 'biagiotti'),
			array( 'description' => esc_html__( 'Display a wishlist icon with number of products that are in the wishlist', 'biagiotti' ) )
		);
	}

    /**
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        foreach($this->params as $param) {
            $param_name = $param['name'];

            $instance[$param_name] = sanitize_text_field($new_instance[$param_name]);
        }

        return $instance;
    }

	public function widget( $args, $instance ) {
		extract( $args );
		
		global $yith_wcwl;
		$unique_id = rand( 1000, 9999 );
		?>
		<div class="mkdf-wishlist-widget-holder">
            <a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" class="mkdf-wishlist-widget-link">
                <span class="mkdf-wishlist-widget-icon"><i class="ion-ios-heart-outline"></i></span>
	            <span class="mkdf-wishlist-widget-count"><?php echo esc_attr( $yith_wcwl->count_all_products() ); ?></span>
            </a>
			<?php wp_nonce_field( 'mkdf_themename_product_wishlist_nonce_' . $unique_id, 'mkdf_themename_product_wishlist_nonce_' . $unique_id ); ?>
		</div>
		<?php
	}
}
