<?php

if ( ! function_exists( 'biagiotti_core_add_import_sub_page_to_list' ) ) {
	function biagiotti_core_add_import_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'BiagiottiCoreImportPage';
		return $sub_pages;
	}
	
	add_filter( 'biagiotti_core_filter_add_sub_page', 'biagiotti_core_add_import_sub_page_to_list', 11 );
}

if ( class_exists( 'BiagiottiCoreSubPage' ) ) {
	class BiagiottiCoreImportPage extends BiagiottiCoreSubPage {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_title( esc_html__('Import', 'biagiotti-core'));
			$this->set_atts( $this->set_atributtes());
		}

		public function set_atributtes(){
			$params = array();

			$iparams = BiagiottiCoreDashboard::get_instance()->get_import_params();
			if(is_array($iparams) && isset($iparams['submit'])) {
				$params['submit'] = $iparams['submit'];
			}

			return $params;
		}
	}
}