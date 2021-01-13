<?php

if ( ! function_exists( 'struktur_select_include_blog_shortcodes' ) ) {
	function struktur_select_include_blog_shortcodes() {
		foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( struktur_select_is_plugin_installed( 'core' ) ) {
		add_action( 'struktur_core_action_include_shortcodes_file', 'struktur_select_include_blog_shortcodes' );
	}
}

// Load woo elementor widgets
if ( ! function_exists( 'struktur_select_include_blog_elementor_widgets_files' ) ) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function struktur_select_include_blog_elementor_widgets_files() {
        if ( struktur_select_is_elementor_installed() ) {
            foreach ( glob( STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/elementor-*.php' ) as $shortcode_load ) {
                include_once $shortcode_load;
            }
        }
    }
    add_action( 'elementor/widgets/widgets_registered', 'struktur_select_include_blog_elementor_widgets_files' );
}