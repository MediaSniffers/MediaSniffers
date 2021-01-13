<?php

if ( ! function_exists( 'struktur_select_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function struktur_select_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_sticky_sidebar_widget' );
}