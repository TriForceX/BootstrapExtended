<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'website_base');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
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
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

