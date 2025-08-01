<?php

if ( ! function_exists( 'biagiotti_mikado_get_subscribe_popup' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function biagiotti_mikado_get_subscribe_popup() {
		
		if ( biagiotti_mikado_options()->getOptionValue( 'enable_subscribe_popup' ) === 'yes' && ( biagiotti_mikado_options()->getOptionValue( 'subscribe_popup_contact_form' ) !== '' || biagiotti_mikado_options()->getOptionValue( 'subscribe_popup_title' ) !== '' ) ) {
			biagiotti_mikado_load_subscribe_popup_template();
		}
	}
	
	//Get subscribe popup HTML
	add_action( 'biagiotti_mikado_action_before_page_header', 'biagiotti_mikado_get_subscribe_popup' );
}

if ( ! function_exists( 'biagiotti_mikado_load_subscribe_popup_template' ) ) {
	/**
	 * Loads HTML template with parameters
	 */
	function biagiotti_mikado_load_subscribe_popup_template() {
		$parameters                             = array();
		$parameters['title']                    = biagiotti_mikado_options()->getOptionValue( 'subscribe_popup_title' );
		$parameters['subtitle']                 = biagiotti_mikado_options()->getOptionValue( 'subscribe_popup_subtitle' );
		$parameters['contact_form']             = biagiotti_mikado_options()->getOptionValue( 'subscribe_popup_contact_form' );
		$parameters['contact_form_style']       = biagiotti_mikado_options()->getOptionValue( 'subscribe_popup_contact_form_style' );
		$parameters['contact_form_description'] = biagiotti_mikado_options()->getOptionValue( 'subscribe_popup_form_description' );
		$parameters['enable_prevent']           = biagiotti_mikado_options()->getOptionValue( 'enable_subscribe_popup_prevent' );
		$parameters['prevent_behavior']         = biagiotti_mikado_options()->getOptionValue( 'subscribe_popup_prevent_behavior' );
		
		$holder_classes   = array();
		$holder_classes[] = $parameters['enable_prevent'] === 'yes' ? 'mkdf-prevent-enable' : 'mkdf-prevent-disable';
		$holder_classes[] = ! empty( $parameters['prevent_behavior'] ) ? 'mkdf-sp-prevent-' . $parameters['prevent_behavior'] : 'mkdf-prevent-session';
		
		$parameters['holder_classes'] = implode( ' ', $holder_classes );
		
		biagiotti_mikado_get_module_template_part( 'templates/subscribe-popup', 'subscribe-popup', '', $parameters );
	}
}