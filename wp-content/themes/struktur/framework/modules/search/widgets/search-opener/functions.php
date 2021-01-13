<?php

if ( ! function_exists( 'struktur_select_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function struktur_select_register_search_opener_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_search_opener_widget' );
}