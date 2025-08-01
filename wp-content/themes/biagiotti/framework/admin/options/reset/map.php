<?php

if ( ! function_exists( 'biagiotti_mikado_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function biagiotti_mikado_reset_options_map() {
		
		biagiotti_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'biagiotti' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = biagiotti_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'biagiotti' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'biagiotti' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_options_map', 'biagiotti_mikado_reset_options_map', biagiotti_mikado_set_options_map_position( 'reset' ) );
}