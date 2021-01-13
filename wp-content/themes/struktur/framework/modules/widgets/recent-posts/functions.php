<?php

if ( ! function_exists( 'struktur_select_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function struktur_select_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_recent_posts_widget' );
}