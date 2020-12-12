<?php

if ( ! function_exists( 'struktur_select_load_modules' ) ) {
	/**
	 * Loades all modules by going through all folders that are placed directly in modules folder
	 * and loads load.php file in each. Hooks to struktur_select_action_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function struktur_select_load_modules() {
		foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_ROOT_DIR . '/modules/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'struktur_select_action_before_options_map', 'struktur_select_load_modules' );
}