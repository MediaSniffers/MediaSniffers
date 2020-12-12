<?php

if ( ! function_exists( 'struktur_select_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function struktur_select_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_sidearea_opener_widget' );
}