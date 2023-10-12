<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define( 'DB_NAME', 'u326272418_distopia' );

/** MySQL database username */
define( 'DB_USER', 'u326272418_distopia' );

/** MySQL database password */
define( 'DB_PASSWORD', 'S10e12c90' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'x `THvE+fJ@m:a8J8@-:E}$)L3hd</9<n~?w6C`]e9[gr=2!25<)km>+HF/8{$Ee' );
define( 'SECURE_AUTH_KEY',  'gxNEHQ4^Vo?7Kg5)plK^s%^}K5MPP(1mo|&L$9E_uAe.m.o{BGb[jod[:Z9$U`z,' );
define( 'LOGGED_IN_KEY',    '9pfeR%6aK3Xg~ys0-;nVJ-{C0%r/3s ~MNCAPETk-#;?]Ek,U6nfa-%_eRYOy?0Z' );
define( 'NONCE_KEY',        'HxW1Tx@{eaemeG.zY:g29De72TDgg]`VdYBHRex#%7D}t.V_/V;qioC0#6=:(=1[' );
define( 'AUTH_SALT',        ']%#Q=qoNsdOl[P_AOt mUTQ%?wW!bNP@N8ndltxjU?uKZ&*mV#?^`$8p>fT.u`W_' );
define( 'SECURE_AUTH_SALT', ';U|Wg|`3j^b_^@TB`aE9<H=Lvys*wVh/{ 0 /&<S@#{#A-C)S3q%#Mv:0J<?tavN' );
define( 'LOGGED_IN_SALT',   'zy$K,O:5-a>Yd-W&LW4T;,04([3Mzd{[}d9tf(Ez&50@y)7SyY3dd!7}JIBvJCU4' );
define( 'NONCE_SALT',       'E#[98w>Y~H[t&nAr=rfl*kXk%284 }F**YqL6aqfq$:,HY]Vg={w93&hO2W}PYCn' );

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

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
