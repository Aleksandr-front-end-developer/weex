<section class="mkdf-side-menu">
	<a <?php biagiotti_mikado_class_attribute( $close_icon_classes ); ?> href="#">
		<?php echo biagiotti_mikado_get_icon_sources_html( 'side_area', true ); ?>
	</a>
    var_dump(is_active_sidebar( 'left-shop-sidebar' ));
    exit();
    <?php if ( is_active_sidebar( 'left-shop-sidebar' ) ) : ?>
        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'left-shop-sidebar' ); ?>
        </aside>
    <?php endif; ?>


<!--    --><?php //if ( is_active_sidebar( 'sidearea-bottom' ) ) {
//		dynamic_sidebar( 'sidearea-bottom' );
//	} ?>
</section>