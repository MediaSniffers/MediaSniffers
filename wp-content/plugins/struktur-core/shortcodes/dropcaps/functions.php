<?php

if ( ! function_exists( 'struktur_core_add_dropcaps_shortcodes' ) ) {
	function struktur_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'StrukturCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'struktur_core_filter_add_vc_shortcode', 'struktur_core_add_dropcaps_shortcodes' );
}