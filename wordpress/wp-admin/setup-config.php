<?php
/**
 * Retrieves and creates the wp-config.php file.
 *
 * The permissions for the base directory must allow for writing files in order
 * for the wp-config.php to be created using this page.
 *
 * @package WordPress
 * @subpackage Administration
 */

// ** Check local enviroment ** //
$localhost = preg_match('/(::1|127.0.0.|192.168.|localhost)/i', $_SERVER['HTTP_HOST']);

// ** Set custom language strings ** //
$lang = stripos( $_REQUEST['language'], 'es' ) !== false;
$word = array(
'server' 			=> array('Server', 'Servidor'),
'local' 			=> array('Local', 'Local'),
'production' 		=> array('Production', 'Producción'),
'local_server' 		=> array('Local server', 'Servidor local'),
'production_server'	=> array('Production server', 'Servidor producción'),
'directory' 		=> array('Main directory', 'Directorio principal'),
'directory_text' 	=> array('Main site directory in <code>server</code>. If is in root directory write a <code>/</code> symbol.', 'Directorio principal en el <code>servidor</code>. Si está en la raíz escribe el símbolo <code>/</code> únicamente.'),
'enabled' 			=> array('Enabled', 'Activado'),
'disabled' 			=> array('Disabled', 'Desactivado'),
'other' 			=> array('Otros', 'Otros'),
'https' 			=> array('Force https', 'Forzar https'),
'https_text' 		=> array('Forces <code>https</code> protocol on production domain', 'Fuerza el protocolo <code>https</code> en el dominio in producción'),
'www' 				=> array('Force www', 'Forzar www'),
'www_text' 			=> array('Forces <code>www</code> on production domain', 'Fuerza el <code>www</code> en el dominio in producción'),
'cron' 				=> array('Cron jobs', 'Trabajos cron'),
'cron_text' 		=> array('Disable scheduled tasks in order to automate things like posts, updates and others', 'Deshabilita tareas programadas automaticas como posts, actualizaciones y otros'),
'root_empty' 		=> array('or leave it empty.', 'o déjalo vacío.'),
'root_text' 		=> array('Usually is <code>root</code>.', 'Usualmente es <code>root</code>.'),

);

/**
 * We are installing.
 */
define('WP_INSTALLING', true);

/**
 * We are blissfully unaware of anything.
 */
define('WP_SETUP_CONFIG', true);

/**
 * Disable error reporting
 *
 * Set this to error_reporting( -1 ) for debugging
 */
error_reporting(0);

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( dirname( __FILE__ ) ) . '/' );
}

require( ABSPATH . 'wp-settings.php' );

/** Load WordPress Administration Upgrade API */
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

/** Load WordPress Translation Installation API */
require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );

nocache_headers();

// Support wp-config-sample.php one level up, for the develop repo.
if ( file_exists( ABSPATH . 'wp-config-sample.php' ) ) {
	$config_file = file( ABSPATH . 'wp-config-sample.php' );
} elseif ( file_exists( dirname( ABSPATH ) . '/wp-config-sample.php' ) ) {
	$config_file = file( dirname( ABSPATH ) . '/wp-config-sample.php' );
} else {
	wp_die( sprintf(
		/* translators: %s: wp-config-sample.php */
		__( 'Sorry, I need a %s file to work from. Please re-upload this file to your WordPress installation.' ),
		'<code>wp-config-sample.php</code>'
	) );
}

// Check if wp-config.php has been created
if ( file_exists( ABSPATH . 'wp-config.php' ) ) {
	wp_die( '<p>' . sprintf(
			/* translators: 1: wp-config.php 2: install.php */
			__( 'The file %1$s already exists. If you need to reset any of the configuration items in this file, please delete it first. You may try <a href="%2$s">installing now</a>.' ),
			'<code>wp-config.php</code>',
			'install.php'
		) . '</p>'
	);
}

// Check if wp-config.php exists above the root directory but is not part of another installation
if ( @file_exists( ABSPATH . '../wp-config.php' ) && ! @file_exists( ABSPATH . '../wp-settings.php' ) ) {
	wp_die( '<p>' . sprintf(
			/* translators: 1: wp-config.php 2: install.php */
			__( 'The file %1$s already exists one level above your WordPress installation. If you need to reset any of the configuration items in this file, please delete it first. You may try <a href="%2$s">installing now</a>.' ),
			'<code>wp-config.php</code>',
			'install.php'
		) . '</p>'
	);
}

$step = isset( $_GET['step'] ) ? (int) $_GET['step'] : -1;

/**
 * Display setup wp-config.php file header.
 *
 * @ignore
 * @since 2.3.0
 *
 * @global string    $wp_local_package
 * @global WP_Locale $wp_locale
 *
 * @param string|array $body_classes
 */
function setup_config_display_header( $body_classes = array() ) {
	$body_classes = (array) $body_classes;
	$body_classes[] = 'wp-core-ui';
	if ( is_rtl() ) {
		$body_classes[] = 'rtl';
	}

	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"<?php if ( is_rtl() ) echo ' dir="rtl"'; ?>>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	<title><?php _e( 'WordPress &rsaquo; Setup Configuration File' ); ?></title>
	<?php wp_admin_css( 'install', true ); ?>
	<style type="text/css">
		.li-spacing {
			padding-bottom: 10px;
			margin-bottom: 10px;
			border-bottom: 1px solid #ccc;
		}
		.form-table {
			border: 1px solid #ddd;
			margin-top: 1em !important;
		}
		.form-table th,
		.form-table  td{
			padding: 10px 20px 10px 10px;
		}
		.form-table thead th,
		.form-table thead td{
			border-bottom: 1px solid #ddd;
			text-align: center;
			color: #0073aa;
		}
		.form-table select {
			line-height: 20px;
			font-size: 15px;
			padding: 3px 5px;
			border: 1px solid #ddd;
			box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
			width: 100%;
		}
		.form-table code,
		li code{
			color: #e83e8c;
		}
	</style>
</head>
<body class="<?php echo implode( ' ', $body_classes ); ?>">
<p id="logo"><a href="<?php echo esc_url( __( 'https://wordpress.org/' ) ); ?>" tabindex="-1"><?php _e( 'WordPress' ); ?></a></p>
<?php
} // end function setup_config_display_header();

$language = '';
if ( ! empty( $_REQUEST['language'] ) ) {
	$language = preg_replace( '/[^a-zA-Z0-9_]/', '', $_REQUEST['language'] );
} elseif ( isset( $GLOBALS['wp_local_package'] ) ) {
	$language = $GLOBALS['wp_local_package'];
}

switch($step) {
	case -1:
		if ( wp_can_install_language_pack() && empty( $language ) && ( $languages = wp_get_available_translations() ) ) {
			setup_config_display_header( 'language-chooser' );
			echo '<h1 class="screen-reader-text">Select a default language</h1>';
			echo '<form id="setup" method="post" action="?step=0">';
			wp_install_language_form( $languages );
			echo '</form>';
			break;
		}

		// Deliberately fall through if we can't reach the translations API.

	case 0:
		if ( ! empty( $language ) ) {
			$loaded_language = wp_download_language_pack( $language );
			if ( $loaded_language ) {
				load_default_textdomain( $loaded_language );
				$GLOBALS['wp_locale'] = new WP_Locale();
			}
		}

		setup_config_display_header();
		$step_1 = 'setup-config.php?step=1';
		if ( isset( $_REQUEST['noapi'] ) ) {
			$step_1 .= '&amp;noapi';
		}
		if ( ! empty( $loaded_language ) ) {
			$step_1 .= '&amp;language=' . $loaded_language;
		}
?>
<h1 class="screen-reader-text"><?php _e( 'Before getting started' ) ?></h1>
<p><?php _e( 'Welcome to WordPress. Before getting started, we need some information on the database. You will need to know the following items before proceeding.' ) ?></p>
<ol>
	<li><?php _e( 'Database name' ); ?> (<?php echo strtolower($word['local_server'][$lang]); ?>)</li>
	<li><?php _e( 'Database username' ); ?> (<?php echo strtolower($word['local_server'][$lang]); ?>)</li>
	<li><?php _e( 'Database password' ); ?> (<?php echo strtolower($word['local_server'][$lang]); ?>)</li>
	<li><?php _e( 'Database host' ); ?> (<?php echo strtolower($word['local_server'][$lang]); ?>)</li>
	<li class="li-spacing"><?php echo $word['directory'][$lang]; ?> (<?php echo strtolower($word['local_server'][$lang]); ?>)</li>
	
	<li><?php _e( 'Database name' ); ?> (<?php echo strtolower($word['production_server'][$lang]); ?>)</li>
	<li><?php _e( 'Database username' ); ?> (<?php echo strtolower($word['production_server'][$lang]); ?>)</li>
	<li><?php _e( 'Database password' ); ?> (<?php echo strtolower($word['production_server'][$lang]); ?>)</li>
	<li><?php _e( 'Database host' ); ?> (<?php echo strtolower($word['production_server'][$lang]); ?>)</li>
	<li class="li-spacing"><?php echo $word['directory'][$lang]; ?> (<?php echo strtolower($word['production_server'][$lang]); ?>)</li>
	
	<li><?php _e( 'Table prefix (if you want to run more than one WordPress in a single database)' ); ?></li>
	<li><?php echo $word['cron'][$lang]; ?> (<?php echo strtolower($word['cron_text'][$lang]); ?>)</li>
	<li><?php echo $word['https'][$lang]; ?> (<?php echo strtolower($word['https_text'][$lang]); ?>)</li>
	<li><?php echo $word['www'][$lang]; ?> (<?php echo strtolower($word['www_text'][$lang]); ?>)</li>
</ol>
<p><?php
	/* translators: %s: wp-config.php */
	printf( __( 'We&#8217;re going to use this information to create a %s file.' ),
		'<code>wp-config.php</code>'
	);
	?>
	<strong><?php
		/* translators: 1: wp-config-sample.php, 2: wp-config.php */
		printf( __( 'If for any reason this automatic file creation doesn&#8217;t work, don&#8217;t worry. All this does is fill in the database information to a configuration file. You may also simply open %1$s in a text editor, fill in your information, and save it as %2$s.' ),
			'<code>wp-config-sample.php</code>',
			'<code>wp-config.php</code>'
		);
	?></strong>
	<?php
	/* translators: %s: Codex URL */
	printf( __( 'Need more help? <a href="%s">We got it</a>.' ),
		__( 'https://codex.wordpress.org/Editing_wp-config.php' )
	);
?></p>
<p><?php _e( 'In all likelihood, these items were supplied to you by your Web Host. If you don&#8217;t have this information, then you will need to contact them before you can continue. If you&#8217;re all ready&hellip;' ); ?></p>

<p class="step"><a href="<?php echo $step_1; ?>" class="button button-large"><?php _e( 'Let&#8217;s go!' ); ?></a></p>
<?php
	break;

	case 1:
		load_default_textdomain( $language );
		$GLOBALS['wp_locale'] = new WP_Locale();

		setup_config_display_header();
	?>
<h1 class="screen-reader-text"><?php _e( 'Set up your database connection' ) ?></h1>
<form method="post" action="setup-config.php?step=2">
	<p><?php _e( 'Below you should enter your database connection details. If you&#8217;re not sure about these, contact your host.' ); ?></p>
	<table class="form-table form-table-local">
		<thead>
			<tr>
				<th colspan="3"><?php echo $word['local_server'][$lang]; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row"><label for="dbname"><?php _e( 'Database Name' ); ?></label></th>
				<td><input name="dbname" id="dbname" type="text" size="25" value="wordpress_<?php echo strtolower($word['local'][$lang]); ?>_db" /></td>
				<td><?php _e( 'The name of the database you want to use with WordPress.' ); ?></td>
			</tr>
			<tr>
				<th scope="row"><label for="uname"><?php _e( 'Username' ); ?></label></th>
				<td><input name="uname" id="uname" type="text" size="25" value="<?php echo htmlspecialchars( _x( 'username', 'example username' ), ENT_QUOTES ); ?>_<?php echo strtolower($word['local'][$lang]); ?>" /></td>
				<td><?php _e( 'Your database username.' ); ?> <?php echo $word['root_text'][$lang]; ?></td>
			</tr>
			<tr>
				<th scope="row"><label for="pwd"><?php _e( 'Password' ); ?></label></th>
				<td><input name="pwd" id="pwd" type="text" size="25" value="<?php echo htmlspecialchars( _x( 'password', 'example password' ), ENT_QUOTES ); ?>_<?php echo strtolower($word['local'][$lang]); ?>" autocomplete="off" /></td>
				<td><?php _e( 'Your database password.' ); ?> <?php echo $word['root_text'][$lang]; ?> <?php echo $word['root_empty'][$lang]; ?></td>
			</tr>
			<tr>
				<th scope="row"><label for="dbhost"><?php _e( 'Database Host' ); ?></label></th>
				<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
				<td><?php
					/* translators: %s: localhost */
					printf( __( 'You should be able to get this info from your web host, if %s doesn&#8217;t work.' ),'<code>localhost</code>' );
				?></td>
			</tr>
			<tr>
				<th scope="row"><label for="directory"><?php echo $word['directory'][$lang]; ?></label></th>
				<td><input name="directory" id="directory" type="text" size="25" value="/wordpress/" /></td>
				<td><?php echo $word['directory_text'][$lang]; ?></td>
			</tr>
		</tbody>
	</table>
	<table class="form-table form-table-local">
		<thead>
			<tr>
				<th colspan="3"><?php echo $word['production_server'][$lang]; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row"><label for="dbname_2"><?php _e( 'Database Name' ); ?></label></th>
				<td><input name="dbname_2" id="dbname_2" type="text" size="25" value="wordpress_<?php echo strtolower($word['production'][$lang]); ?>_db" /></td>
				<td><?php _e( 'The name of the database you want to use with WordPress.' ); ?></td>
			</tr>
			<tr>
				<th scope="row"><label for="uname_2"><?php _e( 'Username' ); ?></label></th>
				<td><input name="uname_2" id="uname_2" type="text" size="25" value="<?php echo htmlspecialchars( _x( 'username', 'example username' ), ENT_QUOTES ); ?>_<?php echo strtolower($word['production'][$lang]); ?>" /></td>
				<td><?php _e( 'Your database username.' ); ?></td>
			</tr>
			<tr>
				<th scope="row"><label for="pwd_2"><?php _e( 'Password' ); ?></label></th>
				<td><input name="pwd_2" id="pwd_2" type="text" size="25" value="<?php echo htmlspecialchars( _x( 'password', 'example password' ), ENT_QUOTES ); ?>_<?php echo strtolower($word['production'][$lang]); ?>" autocomplete="off" /></td>
				<td><?php _e( 'Your database password.' ); ?></td>
			</tr>
			<tr>
				<th scope="row"><label for="dbhost_2"><?php _e( 'Database Host' ); ?></label></th>
				<td><input name="dbhost_2" id="dbhost_2" type="text" size="25" value="localhost" /></td>
				<td><?php
					/* translators: %s: localhost */
					printf( __( 'You should be able to get this info from your web host, if %s doesn&#8217;t work.' ),'<code>localhost</code>' );
				?></td>
			</tr>
			<tr>
				<th scope="row"><label for="directory_2"><?php echo $word['directory'][$lang]; ?></label></th>
				<td><input name="directory_2" id="directory_2" type="text" size="25" value="/" /></td>
				<td><?php echo $word['directory_text'][$lang]; ?></td>
			</tr>
		</tbody>
	</table>
	<table class="form-table form-table-local">
		<thead>
			<tr>
				<th colspan="3"><?php echo $word['other'][$lang]; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row"><label for="prefix"><?php _e( 'Table Prefix' ); ?></label></th>
				<td><input name="prefix" id="prefix" type="text" value="wp_" size="25" /></td>
				<td><?php _e( 'If you want to run multiple WordPress installations in a single database, change this.' ); ?></td>
			</tr>
			<tr>
				<th scope="row"><label for="cron"><?php echo $word['cron'][$lang]; ?></label></th>
				<td><select name="cron" id="cron">
						<option value="true" default><?php echo $word['disabled'][$lang]; ?></option>
						<option value="false" default><?php echo $word['enabled'][$lang]; ?></option>
					</select></td>
				<td><?php echo $word['cron_text'][$lang]; ?>.</td>
			</tr>
			<tr>
				<th scope="row"><label for="https"><?php echo $word['https'][$lang]; ?></label></th>
				<td><select name="https" id="https">
						<option value="false" default><?php echo $word['disabled'][$lang]; ?></option>
						<option value="true" default><?php echo $word['enabled'][$lang]; ?></option>
					</select></td>
				<td><?php echo $word['https_text'][$lang]; ?>.</td>
			</tr>
			<tr>
				<th scope="row"><label for="www"><?php echo $word['www'][$lang]; ?></label></th>
				<td><select name="www" id="www">
						<option value="false" default><?php echo $word['disabled'][$lang]; ?></option>
						<option value="true" default><?php echo $word['enabled'][$lang]; ?></option>
					</select></td>
				<td><?php echo $word['www_text'][$lang]; ?>.</td>
			</tr>
		</tbody>
	</table>
	<?php if ( isset( $_GET['noapi'] ) ) { ?><input name="noapi" type="hidden" value="1" /><?php } ?>
	<input type="hidden" name="language" value="<?php echo esc_attr( $language ); ?>" />
	<p class="step"><input name="submit" type="submit" value="<?php echo htmlspecialchars( __( 'Submit' ), ENT_QUOTES ); ?>" class="button button-large" /></p>
</form>
<?php
	break;

	case 2:
	load_default_textdomain( $language );
	$GLOBALS['wp_locale'] = new WP_Locale();
		
	// Localhost
	$dbname = trim( wp_unslash( $_POST[ 'dbname' ] ) );
	$uname = trim( wp_unslash( $_POST[ 'uname' ] ) );
	$pwd = trim( wp_unslash( $_POST[ 'pwd' ] ) );
	$dbhost = trim( wp_unslash( $_POST[ 'dbhost' ] ) );
	$directory = !empty( trim( $_POST[ 'directory' ] ) ) ? trim( $_POST[ 'directory' ] ) : '/';
		
	// Production
	$dbname_2 = trim( wp_unslash( $_POST[ 'dbname_2' ] ) );
	$uname_2 = trim( wp_unslash( $_POST[ 'uname_2' ] ) );
	$pwd_2 = trim( wp_unslash( $_POST[ 'pwd_2' ] ) );
	$dbhost_2 = trim( wp_unslash( $_POST[ 'dbhost_2' ] ) );
	$directory_2 = !empty( trim( $_POST[ 'directory_2' ] ) ) ? trim( $_POST[ 'directory_2' ] ) : '/';
		
	// Other
	$prefix = trim( wp_unslash( $_POST[ 'prefix' ] ) );
	$cron = trim( wp_unslash( $_POST[ 'cron' ] ) );
	$https = trim( wp_unslash( $_POST[ 'https' ] ) );
	$www = trim( wp_unslash( $_POST[ 'www' ] ) );

	$step_1 = 'setup-config.php?step=1';
	$install = 'install.php';
	if ( isset( $_REQUEST['noapi'] ) ) {
		$step_1 .= '&amp;noapi';
	}

	if ( ! empty( $language ) ) {
		$step_1 .= '&amp;language=' . $language;
		$install .= '?language=' . $language;
	} else {
		$install .= '?language=en_US';
	}

	$tryagain_link = '</p><p class="step"><a href="' . $step_1 . '" onclick="javascript:history.go(-1);return false;" class="button button-large">' . __( 'Try again' ) . '</a>';

	if ( empty( $prefix ) )
		wp_die( __( '<strong>ERROR</strong>: "Table Prefix" must not be empty.' . $tryagain_link ) );

	// Validate $prefix: it can only contain letters, numbers and underscores.
	if ( preg_match( '|[^a-z0-9_]|i', $prefix ) )
		wp_die( __( '<strong>ERROR</strong>: "Table Prefix" can only contain numbers, letters, and underscores.' . $tryagain_link ) );

	// Test the db connection.
	/**#@+
	 * @ignore
	 */
	if ( $localhost ) {
		define('DB_NAME', $dbname);
		define('DB_USER', $uname);
		define('DB_PASSWORD', $pwd);
		define('DB_HOST', $dbhost);
	} else {
		define('DB_NAME', $dbname_2);
		define('DB_USER', $uname_2);
		define('DB_PASSWORD', $pwd_2);
		define('DB_HOST', $dbhost_2);
	}
	/**#@-*/

	// Re-construct $wpdb with these new values.
	unset( $wpdb );
	require_wp_db();

	/*
	 * The wpdb constructor bails when WP_SETUP_CONFIG is set, so we must
	 * fire this manually. We'll fail here if the values are no good.
	 */
	$wpdb->db_connect();

	if ( ! empty( $wpdb->error ) )
		wp_die( $wpdb->error->get_error_message() . $tryagain_link );

	$errors = $wpdb->hide_errors();
	$wpdb->query( "SELECT $prefix" );
	$wpdb->show_errors( $errors );
	if ( ! $wpdb->last_error ) {
		// MySQL was able to parse the prefix as a value, which we don't want. Bail.
		wp_die( __( '<strong>ERROR</strong>: "Table Prefix" is invalid.' ) );
	}

	// Generate keys and salts using secure CSPRNG; fallback to API if enabled; further fallback to original wp_generate_password().
	try {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
		$max = strlen($chars) - 1;
		for ( $i = 0; $i < 8; $i++ ) {
			$key = '';
			for ( $j = 0; $j < 64; $j++ ) {
				$key .= substr( $chars, random_int( 0, $max ), 1 );
			}
			$secret_keys[] = $key;
		}
	} catch ( Exception $ex ) {
		$no_api = isset( $_POST['noapi'] );

		if ( ! $no_api ) {
			$secret_keys = wp_remote_get( 'https://api.wordpress.org/secret-key/1.1/salt/' );
		}

		if ( $no_api || is_wp_error( $secret_keys ) ) {
			$secret_keys = array();
			for ( $i = 0; $i < 8; $i++ ) {
				$secret_keys[] = wp_generate_password( 64, true, true );
			}
		} else {
			$secret_keys = explode( "\n", wp_remote_retrieve_body( $secret_keys ) );
			foreach ( $secret_keys as $k => $v ) {
				$secret_keys[$k] = substr( $v, 28, 64 );
			}
		}
	}

	$key = 0;
	foreach ( $config_file as $line_num => $line ) {
		// Localhost
		if ( stripos( $line, "'name'\t\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'name'\t\t=> '" . $dbname . "',\r\n";
			continue;
		}
		if ( stripos( $line, "'user'\t\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'user'\t\t=> '" . $uname . "',\r\n";
			continue;
		}
		if ( stripos( $line, "'pass'\t\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'pass'\t\t=> '" . $pwd . "',\r\n";
			continue;
		}
		if ( stripos( $line, "'host'\t\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'host'\t\t=> '" . $dbhost . "',\r\n";
			continue;
		}
		if ( stripos( $line, "/wordpress_local/" ) !== false ) {
			$config_file[ $line_num ] = str_replace('/wordpress_local/', preg_replace('#/+#', '/', '/'.$directory.'/'), $line);
			continue;
		}
		
		// Production
		if ( stripos( $line, "'name_2'\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'name_2'\t=> '" . $dbname_2 . "',\r\n";
			continue;
		}
		if ( stripos( $line, "'user_2'\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'user_2'\t=> '" . $uname_2 . "',\r\n";
			continue;
		}
		if ( stripos( $line, "'pass_2'\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'pass_2'\t=> '" . $pwd_2 . "',\r\n";
			continue;
		}
		if ( stripos( $line, "'host_2'\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'host_2'\t=> '" . $dbhost_2 . "',\r\n";
			continue;
		}
		if ( stripos( $line, "/wordpress_prod/" ) !== false ) {
			$config_file[ $line_num ] = str_replace('/wordpress_prod/', preg_replace('#/+#', '/', '/'.$directory_2.'/'), $line);
			continue;
		}
		
		// Other
		if ( stripos( $line, "'prefix'\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'prefix'\t=> '" . $prefix . "',\r\n";
			continue;
		}
		if ( stripos( $line, "'cron'\t\t=> " ) !== false ) {
			$config_file[ $line_num ] = "'cron'\t\t=> " . $cron . ",\r\n";
			continue;
		}
		if ( stripos( $line, "'charset'\t=> " ) !== false ) {
			if ( 'utf8mb4' === $wpdb->charset || ( ! $wpdb->charset && $wpdb->has_cap( 'utf8mb4' ) ) ) {
				$config_file[ $line_num ] = "'charset'\t=> 'utf8mb4',\r\n";
			}
			continue;
		}
		if ( stripos( $line, "# [Remove HTTPS] " ) !== false ) {
			$config_file[ $line_num ] = $https == 'true' ? str_replace('# [Remove HTTPS] ', '# ', $line) : str_replace('# [Remove HTTPS] ', '', $line);
			continue;
		}
		if ( stripos( $line, "# [Force HTTPS] " ) !== false ) {
			$config_file[ $line_num ] = $https == 'true' ? str_replace('# [Force HTTPS] ', '', $line) : str_replace('# [Force HTTPS] ', '# ', $line);
			continue;
		}
		if ( stripos( $line, "# [Remove WWW] " ) !== false ) {
			$config_file[ $line_num ] = $www == 'true' ? str_replace('# [Remove WWW] ', '# ', $line) : str_replace('# [Remove WWW] ', '', $line);
			continue;
		}
		if ( stripos( $line, "# [Force WWW] " ) !== false ) {
			$config_file[ $line_num ] = $www == 'true' ? str_replace('# [Force WWW] ', '', $line) : str_replace('# [Force WWW] ', '# ', $line);
			continue;
		}
		
		if ( ! preg_match( '/^define\(\'([A-Z_]+)\',([ ]+)/', $line, $match ) )
			continue;

		$constant = $match[1];
		$padding  = $match[2];

		switch ( $constant ) {
			case 'AUTH_KEY'         :
			case 'SECURE_AUTH_KEY'  :
			case 'LOGGED_IN_KEY'    :
			case 'NONCE_KEY'        :
			case 'AUTH_SALT'        :
			case 'SECURE_AUTH_SALT' :
			case 'LOGGED_IN_SALT'   :
			case 'NONCE_SALT'       :
				$config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'" . $secret_keys[$key++] . "');\r\n";
				break;
		}
	}
	unset( $line );

	if ( ! is_writable(ABSPATH) ) :
		setup_config_display_header();
?>
<p><?php
	/* translators: %s: wp-config.php */
	printf( __( 'Sorry, but I can&#8217;t write the %s file.' ), '<code>wp-config.php</code>' );
?></p>
<p><?php
	/* translators: %s: wp-config.php */
	printf( __( 'You can create the %s file manually and paste the following text into it.' ), '<code>wp-config.php</code>' );
?></p>
<textarea id="wp-config" cols="98" rows="15" class="code" readonly="readonly"><?php
		foreach ( $config_file as $line ) {
			echo htmlentities($line, ENT_COMPAT, 'UTF-8');
		}
?></textarea>
<p><?php _e( 'After you&#8217;ve done that, click &#8220;Run the installation.&#8221;' ); ?></p>
<p class="step"><a href="<?php echo $install; ?>" class="button button-large"><?php _e( 'Run the installation' ); ?></a></p>
<script>
(function(){
if ( ! /iPad|iPod|iPhone/.test( navigator.userAgent ) ) {
	var el = document.getElementById('wp-config');
	el.focus();
	el.select();
}
})();
</script>
<?php
	else :
		/*
		 * If this file doesn't exist, then we are using the wp-config-sample.php
		 * file one level up, which is for the develop repo.
		 */
		if ( file_exists( ABSPATH . 'wp-config-sample.php' ) )
			$path_to_wp_config = ABSPATH . 'wp-config.php';
		else
			$path_to_wp_config = dirname( ABSPATH ) . '/wp-config.php';

		$handle = fopen( $path_to_wp_config, 'w' );
		foreach ( $config_file as $line ) {
			fwrite( $handle, $line );
		}
		fclose( $handle );
		chmod( $path_to_wp_config, 0666 );
		setup_config_display_header();
?>
<h1 class="screen-reader-text"><?php _e( 'Successful database connection' ) ?></h1>
<p><?php _e( 'All right, sparky! You&#8217;ve made it through this part of the installation. WordPress can now communicate with your database. If you are ready, time now to&hellip;' ); ?></p>

<p class="step"><a href="<?php echo $install; ?>" class="button button-large"><?php _e( 'Run the installation' ); ?></a></p>
<?php
	endif;
	break;
}
?>
<?php wp_print_scripts( 'language-chooser' ); ?>
</body>
</html>
