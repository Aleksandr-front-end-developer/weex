<a itemprop="url" <?php biagiotti_mikado_class_attribute( biagiotti_mikado_get_dropdown_cart_icon_class() ); ?> href="<?php echo esc_url( wc_get_cart_url() ); ?>">
	<span class="mkdf-sc-opener-holder">
		<span class="mkdf-sc-opener-icon"><?php echo biagiotti_mikado_get_icon_sources_html( 'dropdown_cart', false, array( 'dropdown_cart' => 'yes' ) ); ?></span>
		<span class="mkdf-sc-opener-count"><?php
            $cart = WC()->cart;
            if ( !is_null($cart) && !$cart->is_empty() ) {
                echo $cart->cart_contents_count;
            } ?></span>
	</span>
</a>