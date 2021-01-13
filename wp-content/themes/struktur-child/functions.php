<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'struktur_select_child_theme_enqueue_scripts' ) ) {
	function struktur_select_child_theme_enqueue_scripts() {
		$parent_style = 'struktur-select-default-style';
		
		wp_enqueue_style( 'struktur-select-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'struktur_select_child_theme_enqueue_scripts' );
}