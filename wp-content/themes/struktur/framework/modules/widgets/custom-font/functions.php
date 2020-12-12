<?php

if ( ! function_exists( 'struktur_select_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function struktur_select_register_custom_font_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_custom_font_widget' );
}