<?php

if ( ! function_exists( 'struktur_select_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function struktur_select_register_social_icons_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_social_icons_widget' );
}