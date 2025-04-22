<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'info_149' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost:8889' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'dt|__C}4]C;}MVgX(23U $_M./0Q+iHu@fWuPF`r2FJZLT.0}8($N^7d?<rA!:lh' );
define( 'SECURE_AUTH_KEY',  '@wU[4=#1sf^p.ijZ`l1{g>Nf(tL6{YC3ya6BZZOnE=iynT`m>UA[3&=:7UHNHE#J' );
define( 'LOGGED_IN_KEY',    'W^ N~seAP5Y+f|yA 2(SI{5~:RJzIu=Ezy>SJtP!,:#<rB6nR4sI%oUh>3YGl g@' );
define( 'NONCE_KEY',        'hFGBYNI94^Y4||pw6BtK{=i}h9U2!V?;hFu/sGg)Ha$-]|)672$d^4;AJVhX|cS.' );
define( 'AUTH_SALT',        '%ZdPshy_oI<!8jdcW>elQk=$)D`<fAuEe=jQMuD9I-&x5#3@6G{3Xr6VGNw <u-q' );
define( 'SECURE_AUTH_SALT', 'j)]yYpG3;67;IwX@uyY{eCciC%KVsqB)Ayh,_i?lRs|C+K0ZmCpr=<.`vdkmtmPL' );
define( 'LOGGED_IN_SALT',   'eAh|>jRmh&Yr@z od8_dF$,.TJr[{W3OE$SZWrbYd*TonL0EcU(EsDy(}=rfnmiG' );
define( 'NONCE_SALT',       'u]Fy7C?c++ X@iaep={NH0NFj_k-bKFhB[~(EquA]+x?$owCS)B0EDoYF`i1]8=$' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
