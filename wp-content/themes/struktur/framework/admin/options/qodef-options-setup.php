<?php

if ( ! function_exists( 'struktur_select_admin_map_init' ) ) {
	function struktur_select_admin_map_init() {
		do_action( 'struktur_select_action_before_options_map' );
		
		foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_ROOT_DIR . '/admin/options/*/*.php' ) as $module_load ) {
			include_once $module_load;
		}
		
		do_action( 'struktur_select_action_options_map' );
		
		do_action( 'struktur_select_action_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'struktur_select_admin_map_init', 1 );
}