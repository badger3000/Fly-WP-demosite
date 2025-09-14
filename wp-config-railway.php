<?php
/**
 * WordPress Configuration for Railway
 */

// Database Configuration from Railway MySQL service
$database_url = parse_url($_ENV['DATABASE_URL'] ?? '');

define('DB_NAME', ltrim($database_url['path'] ?? 'wordpress', '/'));
define('DB_USER', $database_url['user'] ?? 'root');
define('DB_PASSWORD', $database_url['pass'] ?? '');
define('DB_HOST', ($database_url['host'] ?? 'localhost') . ':' . ($database_url['port'] ?? 3306));

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// WordPress Security Keys
define('AUTH_KEY',         $_ENV['AUTH_KEY'] ?? 'put your unique phrase here');
define('SECURE_AUTH_KEY',  $_ENV['SECURE_AUTH_KEY'] ?? 'put your unique phrase here');
define('LOGGED_IN_KEY',    $_ENV['LOGGED_IN_KEY'] ?? 'put your unique phrase here');
define('NONCE_KEY',        $_ENV['NONCE_KEY'] ?? 'put your unique phrase here');
define('AUTH_SALT',        $_ENV['AUTH_SALT'] ?? 'put your unique phrase here');
define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] ?? 'put your unique phrase here');
define('LOGGED_IN_SALT',   $_ENV['LOGGED_IN_SALT'] ?? 'put your unique phrase here');
define('NONCE_SALT',       $_ENV['NONCE_SALT'] ?? 'put your unique phrase here');

// WordPress Database Table prefix
$table_prefix = 'wp_';

// Environment Settings
define('WP_ENVIRONMENT_TYPE', $_ENV['WP_ENVIRONMENT_TYPE'] ?? 'production');
define('WP_DEBUG', $_ENV['WP_DEBUG'] === 'true');
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// Force HTTPS for Railway deployment
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

// Railway URL handling with forced HTTPS
if (isset($_ENV['RAILWAY_PUBLIC_DOMAIN'])) {
    define('WP_HOME', 'https://' . $_ENV['RAILWAY_PUBLIC_DOMAIN']);
    define('WP_SITEURL', 'https://' . $_ENV['RAILWAY_PUBLIC_DOMAIN']);
} else {
    // For Railway, always assume HTTPS
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:' . ($_ENV['PORT'] ?? 8000);
    define('WP_HOME', 'https://' . $host);
    define('WP_SITEURL', 'https://' . $host);
}

// Force SSL for admin and logins
define('FORCE_SSL_ADMIN', true);

// Fix mixed content issues - always use HTTPS
if (!isset($_SERVER['HTTPS'])) {
    $_SERVER['HTTPS'] = 'on';
}

// Performance Settings
define('WP_CACHE', true);
define('WP_MEMORY_LIMIT', '256M');
define('DISALLOW_FILE_EDIT', true);

// Uploads directory
define('UPLOADS', 'wp-content/uploads');

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . 'wp-settings.php';