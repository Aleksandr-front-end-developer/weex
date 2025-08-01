<?php

//define constants
define( 'BIAGIOTTI_MIKADO_ROOT', get_template_directory_uri() );
define( 'BIAGIOTTI_MIKADO_ROOT_DIR', get_template_directory() );
define( 'BIAGIOTTI_MIKADO_ASSETS_ROOT', BIAGIOTTI_MIKADO_ROOT . '/assets' );
define( 'BIAGIOTTI_MIKADO_ASSETS_ROOT_DIR', BIAGIOTTI_MIKADO_ROOT_DIR . '/assets' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_ROOT', BIAGIOTTI_MIKADO_ROOT . '/framework' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_ROOT_DIR', BIAGIOTTI_MIKADO_ROOT_DIR . '/framework' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT', BIAGIOTTI_MIKADO_ROOT . '/framework/admin/assets' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_ICONS_ROOT', BIAGIOTTI_MIKADO_ROOT . '/framework/lib/icons-pack' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_ICONS_ROOT_DIR', BIAGIOTTI_MIKADO_ROOT_DIR . '/framework/lib/icons-pack' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT', BIAGIOTTI_MIKADO_ROOT . '/framework/modules' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_MODULES_ROOT_DIR', BIAGIOTTI_MIKADO_ROOT_DIR . '/framework/modules' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_HEADER_ROOT', BIAGIOTTI_MIKADO_ROOT . '/framework/modules/header' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_HEADER_ROOT_DIR', BIAGIOTTI_MIKADO_ROOT_DIR . '/framework/modules/header' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_HEADER_TYPES_ROOT', BIAGIOTTI_MIKADO_ROOT . '/framework/modules/header/types' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_HEADER_TYPES_ROOT_DIR', BIAGIOTTI_MIKADO_ROOT_DIR . '/framework/modules/header/types' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_SEARCH_ROOT', BIAGIOTTI_MIKADO_ROOT . '/framework/modules/search' );
define( 'BIAGIOTTI_MIKADO_FRAMEWORK_SEARCH_ROOT_DIR', BIAGIOTTI_MIKADO_ROOT_DIR . '/framework/modules/search' );
define( 'BIAGIOTTI_MIKADO_THEME_ENV', 'false' );
define( 'BIAGIOTTI_MIKADO_PROFILE_SLUG', 'mikado' );
define( 'BIAGIOTTI_MIKADO_OPTIONS_SLUG', 'biagiotti_mikado_theme_menu');

//include necessary files
include_once BIAGIOTTI_MIKADO_ROOT_DIR . '/framework/mkdf-framework.php';
include_once BIAGIOTTI_MIKADO_ROOT_DIR . '/includes/nav-menu/mkdf-menu.php';
require_once BIAGIOTTI_MIKADO_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once BIAGIOTTI_MIKADO_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( file_exists( BIAGIOTTI_MIKADO_ROOT_DIR . '/export' ) ) {
	include_once BIAGIOTTI_MIKADO_ROOT_DIR . '/export/export.php';
}

if ( ! is_admin() ) {
	include_once BIAGIOTTI_MIKADO_ROOT_DIR . '/includes/mkdf-body-class-functions.php';
	include_once BIAGIOTTI_MIKADO_ROOT_DIR . '/includes/mkdf-loading-spinners.php';
}