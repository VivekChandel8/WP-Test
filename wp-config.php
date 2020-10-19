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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '!W76.wz,x!j_jY5^AoJDX1K)G{=yS%X]pn*yr/B>MAGvA%7V0?`7^7[.rvhg]&6y' );
define( 'SECURE_AUTH_KEY',  'k#ETiT}mQ$BXCmN#*6g=auz$[Uvi, F#i8+w]P:7aN(8]4j{6,hv`:_1^(HQrl;^' );
define( 'LOGGED_IN_KEY',    't?|>rC#yL !{irV@ olK9i`.ug{$8l+B*3]+(zMzjhVbx}!:i?Aw1-]e9-<DE/TE' );
define( 'NONCE_KEY',        'D|+Eu$V$.q:mVQDaw}FW X?0s1qXCO4YN4IFH`kVlO0o!fAg8K@Z(g_q~l7sO]?S' );
define( 'AUTH_SALT',        '(-5bt&H3d{QkO$/(i7*6)`#{O<`W&thpz.lgg{6K1zrWK*4>^$Y1>LCtr]6B&)T>' );
define( 'SECURE_AUTH_SALT', 'L2RVc3BS=AtCkG~k<~V}ZJNrL+>pAH$<yLFs^b;rno(u6!4q}_lZ]g?N?5 94dPM' );
define( 'LOGGED_IN_SALT',   '7YPg071L~Z`d%,Z;P(k:F*uTWsXm*2+$Z)DfZ5k.W0M}1&KS4,.?Sj}FRH^$;SH<' );
define( 'NONCE_SALT',       '8.EM(16VH^GggW-+RBfV:-;aG,U:@ile*n=3_:av+u[/fFY+{u]Z7H!H4PM?Nx#2' );

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
