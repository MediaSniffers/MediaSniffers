<?php

if ( ! function_exists( 'struktur_select_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function struktur_select_register_social_icon_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_social_icon_widget' );
}