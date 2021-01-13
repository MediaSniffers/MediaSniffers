<?php

if ( struktur_select_is_plugin_installed( 'contact-form-7' ) ) {
	include_once STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_cf7_widget' );
}

if ( ! function_exists( 'struktur_select_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function struktur_select_register_cf7_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassContactForm7Widget';
		
		return $widgets;
	}
}