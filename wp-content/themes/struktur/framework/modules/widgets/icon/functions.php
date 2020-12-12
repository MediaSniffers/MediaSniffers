<?php

if ( ! function_exists( 'struktur_select_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function struktur_select_register_icon_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_icon_widget' );
}