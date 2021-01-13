<?php

if ( ! function_exists( 'struktur_select_register_header_vertical_sliding_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function struktur_select_register_header_vertical_sliding_type( $header_types ) {
		$header_type = array(
			'header-vertical-sliding' => 'StrukturSelectNamespace\Modules\Header\Types\HeaderVerticalSliding'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'struktur_select_init_register_header_vertical_sliding_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function struktur_select_init_register_header_vertical_sliding_type() {
		add_filter( 'struktur_select_filter_register_header_type_class', 'struktur_select_register_header_vertical_sliding_type' );
	}
	
	add_action( 'struktur_select_action_before_header_function_init', 'struktur_select_init_register_header_vertical_sliding_type' );
}

if ( ! function_exists( 'struktur_select_include_header_vertical_sliding_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function struktur_select_include_header_vertical_sliding_menu( $menus ) {
		if ( ! array_key_exists( 'vertical-navigation', $menus ) ) {
			$menus['vertical-navigation'] = esc_html__( 'Vertical Navigation', 'struktur' );
		}
		
		return $menus;
	}
	
	if ( struktur_select_check_is_header_type_enabled( 'header-vertical-sliding' ) ) {
		add_filter( 'struktur_select_filter_register_headers_menu', 'struktur_select_include_header_vertical_sliding_menu' );
	}
}

if ( ! function_exists( 'struktur_select_get_header_vertical_sliding_main_menu' ) ) {
	/**
	 * Loads vertical menu HTML
	 */
	function struktur_select_get_header_vertical_sliding_main_menu() {
		struktur_select_get_module_template_part( 'templates/vertical-sliding-navigation', 'header/types/header-vertical-sliding' );
	}
}

if ( ! function_exists( 'struktur_select_vertical_sliding_header_holder_class' ) ) {
	/**
	 * Return holder class for this header type html
	 */
	function struktur_select_vertical_sliding_header_holder_class() {
		$center_content = struktur_select_get_meta_field_intersect( 'vertical_header_center_content', struktur_select_get_page_id() );
		$holder_class   = $center_content === 'yes' ? 'qodef-vertical-alignment-center' : 'qodef-vertical-alignment-top';
		
		return $holder_class;
	}
}

if ( ! function_exists( 'struktur_select_get_vertical_sliding_header_icon_class' ) ) {
	/**
	 * Loads vertical closed icon class
	 */
	function struktur_select_get_vertical_sliding_header_icon_class() {
		$classes = array(
			'qodef-vertical-sliding-opener'
		);
		
		$classes[] = struktur_select_get_icon_sources_class( 'vertical_sliding', 'qodef-vertical-sliding-opener' );
		
		return $classes;
	}
}