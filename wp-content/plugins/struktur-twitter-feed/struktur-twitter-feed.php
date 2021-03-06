<?php
/*
Plugin Name: Struktur Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Select Themes
Version: 1.0
*/

define( 'STRUKTUR_TWITTER_FEED_VERSION', '1.0' );
define( 'STRUKTUR_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'STRUKTUR_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'STRUKTUR_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'STRUKTUR_TWITTER_ASSETS_PATH', STRUKTUR_TWITTER_ABS_PATH . '/assets' );
define( 'STRUKTUR_TWITTER_ASSETS_URL_PATH', STRUKTUR_TWITTER_URL_PATH . 'assets' );
define( 'STRUKTUR_TWITTER_SHORTCODES_PATH', STRUKTUR_TWITTER_ABS_PATH . '/shortcodes' );
define( 'STRUKTUR_TWITTER_SHORTCODES_URL_PATH', STRUKTUR_TWITTER_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'struktur_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function struktur_twitter_theme_installed() {
		return defined( 'STRUKTUR_SELECT_ROOT' );
	}
}

if ( ! function_exists( 'struktur_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function struktur_twitter_feed_text_domain() {
		load_plugin_textdomain( 'struktur-twitter-feed', false, STRUKTUR_TWITTER_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'struktur_twitter_feed_text_domain' );
}