<?php

if ( ! function_exists( 'struktur_select_disable_behaviors_for_header_vertical_sliding' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function struktur_select_disable_behaviors_for_header_vertical_sliding( $allow_behavior ) {
		return false;
	}
	
	if ( struktur_select_check_is_header_type_enabled( 'header-vertical-sliding', struktur_select_get_page_id() ) ) {
		add_filter( 'struktur_select_filter_allow_sticky_header_behavior', 'struktur_select_disable_behaviors_for_header_vertical_sliding' );
		add_filter( 'struktur_select_filter_allow_content_boxed_layout', 'struktur_select_disable_behaviors_for_header_vertical_sliding' );
	}
}