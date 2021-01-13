<?php

if ( ! function_exists( 'struktur_select_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function struktur_select_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'StrukturSelectClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'struktur_core_filter_register_widgets', 'struktur_select_register_image_gallery_widget' );
}