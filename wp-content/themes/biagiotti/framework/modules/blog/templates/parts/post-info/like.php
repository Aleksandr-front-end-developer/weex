<?php if( biagiotti_mikado_is_plugin_installed( 'core' ) ) { ?>
    <div class="mkdf-blog-like">
        <?php if( function_exists('biagiotti_mikado_get_like') ) biagiotti_mikado_get_like(); ?>
    </div>
<?php } ?>