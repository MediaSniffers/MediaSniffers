<?php

if ( ! function_exists( 'struktur_core_import_object' ) ) {
	function struktur_core_import_object() {
		$struktur_core_import_object = new StrukturCoreImport();
	}
	
	add_action( 'init', 'struktur_core_import_object' );
}

if ( ! function_exists( 'struktur_core_data_import' ) ) {
	function struktur_core_data_import() {
		$importObject = StrukturCoreImport::getInstance();
		
		if ( $_POST['import_attachments'] == 1 ) {
			$importObject->attachments = true;
		} else {
			$importObject->attachments = false;
		}
		
		$folder = "struktur/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_content( $folder . $_POST['xml'] );
		
		die();
	}
	
	add_action( 'wp_ajax_struktur_core_action_import_content', 'struktur_core_data_import' );
}

if ( ! function_exists( 'struktur_core_widgets_import' ) ) {
	function struktur_core_widgets_import() {
		$importObject = StrukturCoreImport::getInstance();
		
		$folder = "struktur/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_struktur_core_action_import_widgets', 'struktur_core_widgets_import' );
}

if ( ! function_exists( 'struktur_core_options_import' ) ) {
	function struktur_core_options_import() {
		$importObject = StrukturCoreImport::getInstance();
		
		$folder = "struktur/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_struktur_core_action_import_options', 'struktur_core_options_import' );
}

if ( ! function_exists( 'struktur_core_other_import' ) ) {
	function struktur_core_other_import() {
		$importObject = StrukturCoreImport::getInstance();
		
		$folder = "struktur/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		$importObject->import_menus( $folder . 'menus.txt' );
		$importObject->import_settings_pages( $folder . 'settingpages.txt' );
		
		$importObject->qodef_update_meta_fields_after_import( $folder );
		$importObject->qodef_update_options_after_import( $folder );
		
		if ( struktur_core_is_revolution_slider_installed() ) {
			$importObject->rev_slider_import( $folder );
		}
		
		die();
	}
	
	add_action( 'wp_ajax_struktur_core_action_import_other_elements', 'struktur_core_other_import' );
}