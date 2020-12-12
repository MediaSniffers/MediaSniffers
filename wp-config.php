
<?php
define('WP_MEMORY_LIMIT', '256M');
define('DB_NAME', $_SERVER["DB_NAME"]);
define('DB_USER', $_SERVER["DB_USER"]);
define('DB_PASSWORD', $_SERVER["DB_PASSWORD"]);
define('DB_HOST', $_SERVER["DB_HOST"]);
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
define('AUTH_KEY',         $_SERVER['AUTH_KEY']);
define('SECURE_AUTH_KEY',  $_SERVER['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY',    $_SERVER['LOGGED_IN_KEY']);
define('NONCE_KEY',        $_SERVER['NONCE_KEY']);
define('AUTH_SALT',        $_SERVER['AUTH_SALT']);
define('SECURE_AUTH_SALT', $_SERVER['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT',   $_SERVER['LOGGED_IN_SALT']);
define('NONCE_SALT',       $_SERVER['NONCE_SALT']);
$table_prefix  = 'wp_';

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '96M');
@ini_set( 'memory_limit', '256M' );

define('WP_DEBUG', false);
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');