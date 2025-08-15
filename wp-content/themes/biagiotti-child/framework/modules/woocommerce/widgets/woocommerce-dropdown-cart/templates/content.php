<?php biagiotti_mikado_get_module_template_part('widgets/woocommerce-dropdown-cart/templates/parts/opener', 'woocommerce'); ?>
<div class="mkdf-sc-dropdown">
	<button type="buttton" class="mkdf-shopping-cart-holder-close">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
			<polygon fill="#D0D0CF" points="14.012,2.629 13.305,1.922 8.001,7.226 2.697,1.922 1.99,2.629 7.294,7.933 1.99,13.236
					2.698,13.943 8.001,8.64 13.305,13.943 14.012,13.236 8.708,7.933 "></polygon>
		</svg>
	</button>
	<div class="mkdf-sc-dropdown-inner">
		<?php
		$cart = WC()->cart;
		if (!is_null($cart) && !$cart->is_empty()) {
			biagiotti_mikado_get_module_template_part('widgets/woocommerce-dropdown-cart/templates/parts/loop', 'woocommerce');
		?>
			<div class="mkdf-sc-dropdown-bottom-container">
				<?php
				biagiotti_mikado_get_module_template_part('widgets/woocommerce-dropdown-cart/templates/parts/order-details', 'woocommerce');

				biagiotti_mikado_get_module_template_part('widgets/woocommerce-dropdown-cart/templates/parts/button', 'woocommerce');

				?>
			</div>
		<?php
		} else {
			biagiotti_mikado_get_module_template_part('widgets/woocommerce-dropdown-cart/templates/posts-not-found', 'woocommerce');
		} ?>
	</div>
</div>