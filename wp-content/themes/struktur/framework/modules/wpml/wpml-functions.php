<?php

if ( ! function_exists( 'struktur_select_disable_wpml_css' ) ) {
	function struktur_select_disable_wpml_css() {
		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
	
	add_action( 'after_setup_theme', 'struktur_select_disable_wpml_css' );
}