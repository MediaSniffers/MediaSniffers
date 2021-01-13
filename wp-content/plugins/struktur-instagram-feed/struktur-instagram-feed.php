<?php
/*
Plugin Name: Struktur Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Select Themes
Version: 1.0
*/
define('STRUKTUR_INSTAGRAM_FEED_VERSION', '1.0');
define('STRUKTUR_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('STRUKTUR_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));
define( 'STRUKTUR_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'STRUKTUR_INSTAGRAM_ASSETS_PATH', STRUKTUR_INSTAGRAM_ABS_PATH . '/assets' );
define( 'STRUKTUR_INSTAGRAM_ASSETS_URL_PATH', STRUKTUR_INSTAGRAM_URL_PATH . 'assets' );
define( 'STRUKTUR_INSTAGRAM_SHORTCODES_PATH', STRUKTUR_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'STRUKTUR_INSTAGRAM_SHORTCODES_URL_PATH', STRUKTUR_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'struktur_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function struktur_instagram_theme_installed() {
        return defined( 'STRUKTUR_SELECT_ROOT' );
    }
}

if ( ! function_exists( 'struktur_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function struktur_instagram_feed_text_domain() {
		load_plugin_textdomain( 'struktur-instagram-feed', false, STRUKTUR_INSTAGRAM_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'struktur_instagram_feed_text_domain' );
}