<?php

//define constants
define( 'STRUKTUR_SELECT_ROOT', get_template_directory_uri() );
define( 'STRUKTUR_SELECT_ROOT_DIR', get_template_directory() );
define( 'STRUKTUR_SELECT_ASSETS_ROOT', STRUKTUR_SELECT_ROOT . '/assets' );
define( 'STRUKTUR_SELECT_ASSETS_ROOT_DIR', STRUKTUR_SELECT_ROOT_DIR . '/assets' );
define( 'STRUKTUR_SELECT_FRAMEWORK_ROOT', STRUKTUR_SELECT_ROOT . '/framework' );
define( 'STRUKTUR_SELECT_FRAMEWORK_ROOT_DIR', STRUKTUR_SELECT_ROOT_DIR . '/framework' );
define( 'STRUKTUR_SELECT_FRAMEWORK_ADMIN_ASSETS_ROOT', STRUKTUR_SELECT_ROOT . '/framework/admin/assets' );
define( 'STRUKTUR_SELECT_FRAMEWORK_ICONS_ROOT', STRUKTUR_SELECT_ROOT . '/framework/lib/icons-pack' );
define( 'STRUKTUR_SELECT_FRAMEWORK_ICONS_ROOT_DIR', STRUKTUR_SELECT_ROOT_DIR . '/framework/lib/icons-pack' );
define( 'STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT', STRUKTUR_SELECT_ROOT . '/framework/modules' );
define( 'STRUKTUR_SELECT_FRAMEWORK_MODULES_ROOT_DIR', STRUKTUR_SELECT_ROOT_DIR . '/framework/modules' );
define( 'STRUKTUR_SELECT_FRAMEWORK_HEADER_ROOT', STRUKTUR_SELECT_ROOT . '/framework/modules/header' );
define( 'STRUKTUR_SELECT_FRAMEWORK_HEADER_ROOT_DIR', STRUKTUR_SELECT_ROOT_DIR . '/framework/modules/header' );
define( 'STRUKTUR_SELECT_FRAMEWORK_HEADER_TYPES_ROOT', STRUKTUR_SELECT_ROOT . '/framework/modules/header/types' );
define( 'STRUKTUR_SELECT_FRAMEWORK_HEADER_TYPES_ROOT_DIR', STRUKTUR_SELECT_ROOT_DIR . '/framework/modules/header/types' );
define( 'STRUKTUR_SELECT_FRAMEWORK_SEARCH_ROOT', STRUKTUR_SELECT_ROOT . '/framework/modules/search' );
define( 'STRUKTUR_SELECT_FRAMEWORK_SEARCH_ROOT_DIR', STRUKTUR_SELECT_ROOT_DIR . '/framework/modules/search' );
define( 'STRUKTUR_SELECT_THEME_ENV', 'false' );
define( 'STRUKTUR_SELECT_PROFILE_SLUG', 'select' );
define( 'STRUKTUR_SELECT_OPTIONS_SLUG', 'struktur_select_theme_menu');

//include necessary files
include_once STRUKTUR_SELECT_ROOT_DIR . '/framework/qodef-framework.php';
include_once STRUKTUR_SELECT_ROOT_DIR . '/includes/nav-menu/qodef-menu.php';
require_once STRUKTUR_SELECT_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once STRUKTUR_SELECT_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once STRUKTUR_SELECT_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once STRUKTUR_SELECT_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( file_exists( STRUKTUR_SELECT_ROOT_DIR . '/export' ) ) {
	include_once STRUKTUR_SELECT_ROOT_DIR . '/export/export.php';
}

if ( ! is_admin() ) {
	include_once STRUKTUR_SELECT_ROOT_DIR . '/includes/qodef-body-class-functions.php';
	include_once STRUKTUR_SELECT_ROOT_DIR . '/includes/qodef-loading-spinners.php';
}