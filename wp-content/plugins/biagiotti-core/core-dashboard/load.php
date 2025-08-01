<?php
if ( ! function_exists( 'biagiotti_core_dashboard_load_files' ) ) {
	function biagiotti_core_dashboard_load_files() {
		require_once BIAGIOTTI_CORE_ABS_PATH . '/core-dashboard/core-dashboard.php';
		require_once BIAGIOTTI_CORE_ABS_PATH . '/core-dashboard/rest/include.php';
		require_once BIAGIOTTI_CORE_ABS_PATH . '/core-dashboard/registration-rest.php';
		require_once BIAGIOTTI_CORE_ABS_PATH . '/core-dashboard/validation-rest.php';
		require_once BIAGIOTTI_CORE_ABS_PATH . '/core-dashboard/sub-pages/sub-page.php';

		foreach (glob(BIAGIOTTI_CORE_ABS_PATH . '/core-dashboard/sub-pages/*/load.php') as $subpages) {
			include_once $subpages;
		}
	}

	add_action('after_setup_theme', 'biagiotti_core_dashboard_load_files');
}
