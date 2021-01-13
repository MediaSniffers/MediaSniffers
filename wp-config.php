<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mediasniffers' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'U*^f0Jb.il,4YtNy-V+78nMREu;?Q)e(bz$X&b[}$5.wThG-Dr1$,@Hk8hi/OI.1' );
define( 'SECURE_AUTH_KEY',  'U0hzoc2AiU)$J2,)N~|/8^kQRcBcNbvk5Jm9f~V+NoE$9L$KYr.2XTdOMt28V8~C' );
define( 'LOGGED_IN_KEY',    '_1vyp b!+O0a%vE5h>;UlX:_q]j,D}S8hY.erxxd,xZEg~rS5r$OClWYxMiR~pr{' );
define( 'NONCE_KEY',        'wKSiBG[j>`}dhUHI?~Jw:cb:f?/2E*A9>VcF..9]&+WnDianDe>Fa=kmcym,2lh&' );
define( 'AUTH_SALT',        'I88:/*rzeH?od@2pB9[acpy#<4}a0:;Nd*!A(]USVbYV5rWXr}|XM;MhLpC&_-(F' );
define( 'SECURE_AUTH_SALT', '17RG0o{i4`Rgk U[)TR8YA9AxmFidQ|t5XvLDIg6.p&rpkSA9<aoW+!JvZIjXyfI' );
define( 'LOGGED_IN_SALT',   'zD%5AgaDZ6I(D tsFH3O)xFt{3Msxt(&T&9Scc1j)StXtDqQZd#ERE`r(t;sy!!c' );
define( 'NONCE_SALT',       'H^ff.f(=bP%Ye11XNc PTMQd&f< C5%@.S:858LV<?*90DWr,-v4OC9Q^,<5iWF1' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
