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
define( 'DB_NAME', 'cybercoast' );

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
define('FS_METHOD', 'direct');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ZS<XSF?-e`ASKYem Cvb6:T!/zlF9by+g&>%hR`+kR<6^ZNB4armg-QAGs.a!}&/' );
define( 'SECURE_AUTH_KEY',  'HA8B*zaJ4t4R{gSJR_4*-*p0qM(;Ra&0PAY@5KX+L8xCHCW*M/X?sQ{^gcs8ec){' );
define( 'LOGGED_IN_KEY',    'Fm(@NaG9>,HU;p`l?Txx!QBzTo,W7W{I7)8&D[reje78F;%@7N~qPEd .U{ugs1N' );
define( 'NONCE_KEY',        'v#`}-+atfeO>i>)si{H=<HA&bl!=RTpwUrwx(Ii7q2T*V^Em^?&emaC.wU|z9^j2' );
define( 'AUTH_SALT',        '$8goL;5ytT75z@:<c.tzONGo#)/Ec&#jh/[[f)aO3zCJdI.(5/b^*XF/>nT}OX{o' );
define( 'SECURE_AUTH_SALT', 'bdIs!LgSGU/,pTH?87>~`~LwfagYD0?|Do94=uV#LyYk0:Sc{TxPm^RcPw {s%F$' );
define( 'LOGGED_IN_SALT',   'w*+jH64z48n8-PrY/?R!QKO.en4 :871aHhasTnRjL^6w#`>:,prB}m9Ji+2}{mz' );
define( 'NONCE_SALT',       '<u{%!7i.O8_+*@$hMI#zZS%Q@JsB/rZ`&+lDNLqqGxXqv[ZqJcqgU@sdg_2XzFTK' );

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
