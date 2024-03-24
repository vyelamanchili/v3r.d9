<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL cookie settings

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'v3r_deals_wordpress' );

/** Database username */
define( 'DB_USER', 'v3r' );

/** Database password */
define( 'DB_PASSWORD', 'v3rpassword' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'F2OD|X=(p{q5_Fu6zGS??dV56=H@4mNBu9Z{QxS!|mSqG&Wq,-1a3W9t^4hz06dQ' );
define( 'SECURE_AUTH_KEY',  'BH9(*K;Vo(!5OODG`GKHi|tTQ{c[}V9Wp5Hmmm?RGH]LI{UkLY$=UNPNsHftHM72' );
define( 'LOGGED_IN_KEY',    ',hv+,i9Q, uQ%4bY|L/ENC,q@$FQz*utVmIK59x&&c2 #$^a4>`VC5[eoq0I1#dF' );
define( 'NONCE_KEY',        'c2{@eHK,DQGEKcXEXd;38ml!*F~HVMG9WLdyv7c{&!lrlr-Dodga4?fT7w]OqN_b' );
define( 'AUTH_SALT',        '3O$9T#bv&ZXi`n0u=LobYm|vwF[5r^1rC@6F[}-#0g)Qn[t94;C%O:Jz(#88*S7 ' );
define( 'SECURE_AUTH_SALT', 's-:}Ns>1V192UeppM^0g24f]f+0K!:*1W43LZ&In67k}-OG/k)(pSpUrnv3*Ef[q' );
define( 'LOGGED_IN_SALT',   'T-m:&OCLt?xOmIBI*HJ-)fA~}EI.+x()Kvqp1E%&(GTe:,8_=j0~WHau#_)sbg~R' );
define( 'NONCE_SALT',       'aFESJuvbt3[wzt/KB#obf]fW[aW`!6gG(mDes]INN?XdCl|F8TT+%+ZNt|j}I.9d' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
	$_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
}

define('FORCE_SSL_ADMIN', true);

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
