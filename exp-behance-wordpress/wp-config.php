<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'behance_local');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'mG|eoS3a?=oK. :}_@{bT3tL$1?<ar{?b8~:iPYtkR99]0J=H+-e0>=Isr>*X ;1');
define('SECURE_AUTH_KEY',  '>``yrs:!8kV%5447d2yfpX`l8a?~+V-aA/W?,hhSJf|r@oFGC-`s~<bz]S (K=-B');
define('LOGGED_IN_KEY',    '.|f_.%MVAL|i9C@yv*)Vog,C<[5=#>IA2zWjh=CY0yFy#nwdw$MQl@4m;Gw` H9|');
define('NONCE_KEY',        'Hf%q1Ay@Ly?d`*I`<iij(}Ic7VI~H-2#uc/#;3*:X<qXBaM+s YX0r?J-?-!2U+|');
define('AUTH_SALT',        '6N$oT|~TP]||WB|*L zbu-:1[L}UHpvpx5N @zO,Pe^TnAWc2B! S}9Y-`@j9s)|');
define('SECURE_AUTH_SALT', ':l>FwKf/~l ([9}wV>uo|j0HmYk75Wcb3$Ke<n;n}/+S[-#[?lj<cDsE9|%|r6;B');
define('LOGGED_IN_SALT',   '#rHD17YHD@}it&dRic8iA/N+#&|Kgidr~7B/d/7.F&(WCD!cw_?=e nOB+C/dekO');
define('NONCE_SALT',       '.E:mJxTG,}G$>jhc0#$(/|3S;=w|;/3-jd&A1)fib::c8SqBEbZ)EEz T/$6#F|9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 *	Define the home url and the site url as the server the install lives on.
 */
define( 'WP_HOME' ,    'http://' . $_SERVER['SERVER_NAME']);
define( 'WP_SITEURL' , 'http://' . $_SERVER['SERVER_NAME']);
define( 'WP_MEMORY_LIMIT' , '96M' );

$helpers = array(

	/**
	 * Environment Booleans
	 * @return [boolean] true if matches environment, false if doesn't
	 */
	'isLocal' => function() {
		$u_local = array( 'local.behance.com' );
		return in_array( $_SERVER['SERVER_NAME'] , $u_local ) ? true : false;
	},
	'isDev' => function() {
		$u_dev = array( 'expbehance.devonhirth.com' );
		return in_array( $_SERVER['SERVER_NAME'] , $u_dev ) ? true : false;
	},
	'isStage' => function() {
		$u_stage = array( '' );
		return in_array( $_SERVER['SERVER_NAME'] , $u_stage ) ? true : false;
	},
	'isProd' => function() {
		$u_prod = array( '' );
		return in_array( $_SERVER['SERVER_NAME'] , $u_prod ) ? true : false;
	}

);

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
