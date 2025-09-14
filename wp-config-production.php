<?php
/**
 * Production WordPress Configuration
 */

// Database Configuration - MySQL
define('DB_NAME', $_ENV['WORDPRESS_DB_NAME'] ?? 'wordpress');
define('DB_USER', $_ENV['WORDPRESS_DB_USER'] ?? 'wordpress_user');
define('DB_PASSWORD', $_ENV['WORDPRESS_DB_PASSWORD'] ?? '');
define('DB_HOST', $_ENV['WORDPRESS_DB_HOST'] ?? 'flywp-mysql.internal');

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// Security Keys (set via Fly secrets)
define('AUTH_KEY',         $_ENV['AUTH_KEY'] ?? '');
define('SECURE_AUTH_KEY',  $_ENV['SECURE_AUTH_KEY'] ?? '');
define('LOGGED_IN_KEY',    $_ENV['LOGGED_IN_KEY'] ?? '');
define('NONCE_KEY',        $_ENV['NONCE_KEY'] ?? '');
define('AUTH_SALT',        $_ENV['AUTH_SALT'] ?? '');
define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] ?? '');
define('LOGGED_IN_SALT',   $_ENV['LOGGED_IN_SALT'] ?? '');
define('NONCE_SALT',       $_ENV['NONCE_SALT'] ?? '');

// WordPress Database Table prefix
$table_prefix = 'wp_';

// Production Settings
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
define('WP_ENVIRONMENT_TYPE', 'production');
define('DISALLOW_FILE_EDIT', true);
define('AUTOMATIC_UPDATER_DISABLED', true);

// Performance Settings
define('WP_CACHE', true);
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// URL Configuration for Fly.io
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
define('WP_HOME', $protocol . '://' . $_SERVER['HTTP_HOST']);
define('WP_SITEURL', $protocol . '://' . $_SERVER['HTTP_HOST']);

// File Upload Settings
define('UPLOADS', '/var/www/html/wp-content/uploads');
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_execution_time', 300);

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . 'wp-settings.php';