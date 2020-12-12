<?php

if ( ! function_exists( 'struktur_select_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function struktur_select_register_separator_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_separator_widget' );
}