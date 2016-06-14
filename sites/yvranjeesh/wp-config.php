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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/var/www/html/v3r.us/docroot/sites/yvranjeesh/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'v3r_yvranjeesh_wordpress');

/** MySQL database username */
define('DB_USER', 'v3r');

/** MySQL database password */
define('DB_PASSWORD', 'Ranjureetu59');

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
define('AUTH_KEY',         'l+rT4;iIEjiAj+88tcdl~GQc)lYDEvN|23Z@w^FMFLeX:Q8OY%W@7cG1bjHB_@uv');
define('SECURE_AUTH_KEY',  'Vea^5YFuz:?GXU|8)V&*"vxqtYH2bJW(xkotUCwv+`Avj8o)4S@WPw"KKN(MsTu_');
define('LOGGED_IN_KEY',    '4"s(q^15o"AGk(rQ;d^9Sft%yv"nh6a~D`0cODMil3HhmwKQ+DH$jDvL*IVNywZv');
define('NONCE_KEY',        'oE&2p#Vf|?Umi!N/ZQo4ARgb8SmKVT#hKh6Wn_GzL?b59;fi?FhWk*;nRd0d!w`f');
define('AUTH_SALT',        'fpEdMAJqQB`mMvm9+`GGKm`|y*eM:XmAJAfPv^CUxy(8QAECJ"y^YArN$BuW|GS3');
define('SECURE_AUTH_SALT', '!G)CeB+BR1!+n;sTDrub:Z6n0!?tnI!sh+XZv*9_)hKRcw/R:fNYlOKWNaH7l0d?');
define('LOGGED_IN_SALT',   'ZKYIxyOw8T7*Mq|`LKY!k~BVdA0uNflRbJ)nh$6XUMFshozuglxc!pE7uw|u%ikh');
define('NONCE_SALT',       ';i0S|#ipWOy1g_m*!7v7:o|8`?%4r9YWgQj5iWQ7pm$fKPhvRURwaR/O(FmPVF|a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_zajcrp_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

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

