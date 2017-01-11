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
define('DB_NAME', 'wordpress_20170110');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'vcKG?(j5x}|R6M T]v2nA1y<K+HvP;$^mC}JS1:K(6+f7[h}F|?xKM0sKi=26c5^');
define('SECURE_AUTH_KEY',  'VXtHI<TBm;^q{<N2//_=BtDU,ODD3Y*;1Ihw1[G0pFNx9h+&O&GyIn3:^[Q(LT!w');
define('LOGGED_IN_KEY',    'RZP_;d!;HFE]ERB[$Xh|fiI/+.4?^~.j1?G]!r6)@.x#O?cd##3;OvEybZHvbn.f');
define('NONCE_KEY',        'WiS+G|LBpOcAlwW,BbaM$Sl]8D}T4CzS@/Uj>SEob[w6?Vo/tl}z6eli&DA*UyZT');
define('AUTH_SALT',        'C/4)Q/-.*vLpHCEZE_iJVPPJBIyFqh{.5X<?RZTnMW~{z@)8TfyJXJOBdB}&`6#w');
define('SECURE_AUTH_SALT', '@!}8]-{@=#~+aN&YQYCtrpX7vOQ0>j#e;Sn}8|X+l`KQwODU7/{u@C&KU}1e$Eb5');
define('LOGGED_IN_SALT',   'E%Z-U<o=>8a^}kn5G99:V.L0FMe:@vDe7X#{:`[fx&u!oJf<^5%%~|M.rRBy~r}k');
define('NONCE_SALT',       '_A]92Cz4}]#ydKic~t_Mev/-q%;3 V6y26M4=9Lb8V>C;H%1PKc,3PxpGq%C;J18');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
