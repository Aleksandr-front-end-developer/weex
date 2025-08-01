<?php biagiotti_mikado_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/opener', 'woocommerce' ); ?>
<div class="mkdf-sc-dropdown">
	<div class="mkdf-sc-dropdown-inner">
		<?php
        $cart = WC()->cart;
         if ( !is_null($cart) && !$cart->is_empty() ) {
             biagiotti_mikado_get_module_template_part('widgets/woocommerce-dropdown-cart/templates/parts/loop', 'woocommerce');

             biagiotti_mikado_get_module_template_part('widgets/woocommerce-dropdown-cart/templates/parts/order-details', 'woocommerce');

             biagiotti_mikado_get_module_template_part('widgets/woocommerce-dropdown-cart/templates/parts/button', 'woocommerce');
         } else {
             biagiotti_mikado_get_module_template_part('widgets/woocommerce-dropdown-cart/templates/posts-not-found', 'woocommerce');
         } ?>
	</div>
</div>