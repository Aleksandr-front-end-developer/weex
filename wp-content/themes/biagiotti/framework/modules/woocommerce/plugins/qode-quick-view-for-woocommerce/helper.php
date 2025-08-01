<?php

if ( ! function_exists( 'biagiotti_mikado_woocommerce_qode_quick_view_template_single_title' ) ) {
    /**
     * Function for overriding product title template in QODE Quick View plugin template
     */
    function biagiotti_mikado_woocommerce_qode_quick_view_template_single_title() {
        the_title( '<h2  itemprop="name" class="mkdf-qode-quick-view-product-title entry-title">', '</h2>' );
    }
}