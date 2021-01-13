<?php

if ( ! function_exists( 'struktur_select_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function struktur_select_register_button_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_button_widget' );
}