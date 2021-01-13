<?php

if ( ! function_exists( 'struktur_select_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function struktur_select_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'struktur' );
		
		return $type;
	}
	
	add_filter( 'struktur_select_filter_title_type_global_option', 'struktur_select_set_title_centered_type_for_options' );
	add_filter( 'struktur_select_filter_title_type_meta_boxes', 'struktur_select_set_title_centered_type_for_options' );
}