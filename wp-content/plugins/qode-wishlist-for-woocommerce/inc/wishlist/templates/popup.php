<?php

if (! defined('ABSPATH')) {
	// Exit if accessed directly.
	exit;
}

$added_text_option = qode_wishlist_for_woocommerce_get_option_value('admin', 'qode_wishlist_for_woocommerce_successfully_added_text');
$added_text        = ! empty($added_text_option) ? $added_text_option : __('<span><span class="it-en">Item is added</span><span class="it-uk">Товар додано</span><span class="it-ru">Товар добавлен</span>', 'qode-wishlist-for-woocommerce');
?>
<p class="qwfw-m-response qwfw--added">
	<?php
	qode_wishlist_for_woocommerce_svg_icon('check', 'qwfw-m-response-icon');
	echo wp_kses_post($added_text);
	?>
</p>