<?php

if ( ! function_exists( 'struktur_select_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function struktur_select_register_blog_list_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_blog_list_widget' );
}