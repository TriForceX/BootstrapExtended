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
$database = array('charset' => 'utf8mb4',
				  'collate' => '',
				  'prefix' 	=> 'wp_',
				  'cron'	=> true,
				  'debug'	=> false);

if(preg_match('/(::1|127.0.0.|192.168.|localhost)/i', $_SERVER['HTTP_HOST'])):
	 //Localhost
	$database['name'] = 'websitebase';
	$database['user'] = 'root';
	$database['pass'] = 'root';
	$database['host'] = 'localhost';
elseif($_SERVER['HTTP_HOST'] == 'domain.com'):
	//Develop
	$database['name'] = 'websitebase';
	$database['user'] = 'root';
	$database['pass'] = 'root';
	$database['host'] = 'localhost';
else:
	//Production
	$database['name'] = 'websitebase';
	$database['user'] = 'root';
	$database['pass'] = 'root';
	$database['host'] = 'localhost';
endif;

/** The name of the database for WordPress */
define('DB_NAME', $database['name']);

/** MySQL database username */
define('DB_USER', $database['user']);

/** MySQL database password */
define('DB_PASSWORD', $database['pass']);

/** MySQL hostname */
define('DB_HOST', $database['host']);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', $database['charset']);

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', $database['collate']);

/** CRON disable for scheduled tasks */
define('DISABLE_WP_CRON', $database['cron']);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'gQry#z]LR9=7h^2$u4Z3.25eB3HmMLmBiq,iLgcvN@~u_t/kB~q9S1W$3pYNa{02');
define('SECURE_AUTH_KEY', 'h2hvm@%m~AB{NoQrBg/&yGo,-=E@F^?YrbRBJORLJQ2{s!bNMA4AY(y/,znp[ONd');
define('LOGGED_IN_KEY', 'ZQ}k<;:l}&)oX_c%&M!4MQ~u]3n=J>~1R8,!I$ X@!?ks(hG19OcV02_]_^g~cGR');
define('NONCE_KEY', '*)p(&f[1)bmS2CxPpIcq3N[d#?D3`Fy2`-U$LAZvnc+G=$.1_xn<OzuR$go.DMkd');
define('AUTH_SALT', 'Q#uEq8H@K-TUgK6Qc9Qu==`zhRegQqm(~ ^PHdV`#6pNYw7m}(n)$},l4*z$A[{(');
define('SECURE_AUTH_SALT', 'LLFWDbR_aj xlx]NA~qaqYu_b_/3TEr_1^4Cel5UF;_:+{:g><|[tpf7+#n5c]d9');
define('LOGGED_IN_SALT', '!dj*7j^jY+KJI>VM+NlJ42W5?)A/WEcGUIU!W^ C0 P3{@kKxYCC^BDUC56u1U<_');
define('NONCE_SALT', '*:Vo_s-~pOYEhhQzt/Qm$8@$xiNWxjsc0)Aq%cfYKO3~EODldO^NN>n<i$?YzYn[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = $database['prefix'];


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
define('WP_DEBUG', $database['debug']);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
