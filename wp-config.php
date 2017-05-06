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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'gnecN-N)N9iP=p*@Re|z/CH]|r4nUJ`$HY6?B]4oOs)h?`$ooHdFDL!~vS0LG)Y!');
define('SECURE_AUTH_KEY',  '.MWoX|4O2_JqNiS.S]`[(MfD{R_Wz?>4N}VT2~*9}fE+&NUJ!t1/3h:E?MUV.rqk');
define('LOGGED_IN_KEY',    '(+Pvh&uE]Bh2k>^g7JH)mbZ^Q)X`lQzO~e;<EJij dvi4K)nU/r5&K~yf_[A3$0W');
define('NONCE_KEY',        '}e[K?Rl!$#(^tFf+jcBMn6W.KqAvE-052p],&sLfg7!j~Sc{=*ymMBB;<fOY3#a%');
define('AUTH_SALT',        '19XVN#DwrMb<]5w3{y(G{Uljrfs/t1(O5FM-ZL*D8=GDx%GK]@>n?~2c7=zdrpjC');
define('SECURE_AUTH_SALT', 'omyiO86c8c-[{6$c9ag#Iv_al#<GLc]Sv;SyOu<bI5]Is8cWphW]y5<6m &]-o>e');
define('LOGGED_IN_SALT',   'J/ItMJ~5x4bW,`,_[ei/vPNOUYu>IolJLmxqq+x9kd&jo)-ApP$?2W3K>MhS5NdG');
define('NONCE_SALT',       'T$G=v.ismm jYk257u%]bhv7Eww)DdP#DVQ:6*4;u+cC }q[myQ;G/OtXVLY,O~b');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'fbi_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
