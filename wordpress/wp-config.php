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

//** Check local enviroment ** //
$localhost = preg_match('/(::1|127.0.0.|192.168.|localhost)/i', $_SERVER['HTTP_HOST']);

// ** MySQL settings - You can get this info from your web host ** //
$database = array('charset' => 'utf8mb4',
				  'collate' => '',
				  'prefix' 	=> 'wp_',
				  'cron'	=> true,
				  'debug'	=> false);

if($localhost):
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
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

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

/** Delete database dir if is not local enviroment **/
if ( !$localhost && is_dir('wp-db') )
{
	foreach(glob('wp-db/{,.}*', GLOB_BRACE) as $filename)
	{
		if(is_file($filename)) unlink($filename);
	}
	rmdir('wp-db');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
