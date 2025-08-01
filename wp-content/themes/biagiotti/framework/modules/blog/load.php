<?php

include_once BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/blog-functions.php';
include_once BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/shortcodes-functions.php';

//load global blog options
include_once BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/options-map/blog-map.php';

//load per page blog options
include_once BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/blog-meta-boxes.php';

//load per page unique blog template options
foreach ( glob( BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/templates/*/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}