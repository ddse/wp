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
 // Include the Composer autoload file.
require_once( __DIR__ . '/vendor/autoload.php' );
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);
define('DISABLE_WP_CRON', filter_var(getenv("DISABLE_WP_CRON"), FILTER_VALIDATE_BOOLEAN));
define('FORCE_SSL_LOGIN', filter_var(getenv("FORCE_SSL"),       FILTER_VALIDATE_BOOLEAN));
define('FORCE_SSL_ADMIN', filter_var(getenv("FORCE_SSL"),       FILTER_VALIDATE_BOOLEAN));
/**
 * Define site and home URLs
 */
$scheme = 'http';
if ((isset( $_SERVER['HTTP_USER_AGENT_HTTPS'] ) && $_SERVER['HTTP_USER_AGENT_HTTPS'] == 'ON') || strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
	$_SERVER['HTTPS']='on';
	$scheme = 'https';
}
$site_url = $scheme . '://' . $_SERVER['HTTP_HOST'];
define('WP_HOME',    $site_url         );
define('WP_SITEURL', $site_url . '/cms');
/*
* Define wp-content directory outside of WordPress core directory
*/
define('WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content'   );
define('WP_CONTENT_URL', WP_HOME .             '/wp-content'   );
// Sendgrid settings - Read in the sendgrid auth from the config //
define('SENDGRID_AUTH_METHOD',  'credentials'                  );
define('SENDGRID_USERNAME',     getenv("SENDGRID_USERNAME")    );
define('SENDGRID_PASSWORD',     getenv("SENDGRID_PASSWORD")    );
// S3 Config Info - read the S3 Access Keys from the config //
define('AWS_ACCESS_KEY_ID',     getenv("AWS_ACCESS_KEY_ID")    );
define('AWS_SECRET_ACCESS_KEY', getenv("AWS_SECRET_ACCESS_KEY"));
// ** DB settings - from Heroku Environment ** //
if (getenv("JAWSDB_URL")) {
	$db = parse_url(getenv("JAWSDB_URL"));
}
else if (getenv("JAWSDB_MARIA_URL")) {
	$db = parse_url(getenv("JAWSDB_MARIA_URL"));
}
else if (getenv("CLEARDB_DATABASE_URL")) {
	$db = parse_url(getenv("CLEARDB_DATABASE_URL"));
}
else {
	die('JAWSDB_URL or JAWSDB_MARIA_URL or CLEARDB_DATABASE_URL $_ENV variable not set.');
}
define('DB_NAME',     trim($db["path"],"/"));
define('DB_USER',     $db["user"]          );
define('DB_PASSWORD', $db["pass"]          );
define('DB_HOST',     $db["host"]          );
define('DB_CHARSET', 'utf8mb4'             );
define('DB_COLLATE', ''                    );
// ** Heroku Redis settings - from Heroku Environment ** //
$redis = parse_url(getenv("REDIS_URL")    );
define('WP_REDIS_HOST',     $redis["host"]);
define('WP_REDIS_PORT',     $redis["port"]);
define('WP_REDIS_PASSWORD', $redis["pass"]);
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
