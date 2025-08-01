<?php

if ( ! function_exists( 'biagiotti_core_import_object' ) ) {
	function biagiotti_core_import_object() {
		$biagiotti_core_import_object = new BiagiottiCoreImport();
	}
	
	add_action( 'init', 'biagiotti_core_import_object' );
}

if ( ! function_exists( 'biagiotti_core_data_import' ) ) {
	function biagiotti_core_data_import() {
		$importObject = BiagiottiCoreImport::getInstance();
		
		if ( $_POST['import_attachments'] == 1 ) {
			$importObject->attachments = true;
		} else {
			$importObject->attachments = false;
		}
		
		$folder = "biagiotti/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_content( $folder . $_POST['xml'] );
		
		die();
	}
	
	add_action( 'wp_ajax_biagiotti_core_action_import_content', 'biagiotti_core_data_import' );
}

if ( ! function_exists( 'biagiotti_core_widgets_import' ) ) {
	function biagiotti_core_widgets_import() {
		$importObject = BiagiottiCoreImport::getInstance();
		
		$folder = "biagiotti/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_biagiotti_core_action_import_widgets', 'biagiotti_core_widgets_import' );
}

if ( ! function_exists( 'biagiotti_core_options_import' ) ) {
	function biagiotti_core_options_import() {
		$importObject = BiagiottiCoreImport::getInstance();
		
		$folder = "biagiotti/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_biagiotti_core_action_import_options', 'biagiotti_core_options_import' );
}

if ( ! function_exists( 'biagiotti_core_other_import' ) ) {
	function biagiotti_core_other_import() {
		$importObject = BiagiottiCoreImport::getInstance();
		
		$folder = "biagiotti/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		$importObject->import_menus( $folder . 'menus.txt' );
		$importObject->import_settings_pages( $folder . 'settingpages.txt' );
		
		$importObject->mkdf_update_meta_fields_after_import( $folder );
		$importObject->mkdf_update_options_after_import( $folder );
		
		if ( biagiotti_core_is_revolution_slider_installed() ) {
			$importObject->rev_slider_import( $folder );
		}
		
		die();
	}
	
	add_action( 'wp_ajax_biagiotti_core_action_import_other_elements', 'biagiotti_core_other_import' );
}