<?php

if ( ! function_exists( 'struktur_select_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function struktur_select_register_author_info_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_author_info_widget' );
}