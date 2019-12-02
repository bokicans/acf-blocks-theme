<?php
/**
 * Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Constant definitions.
 */
define( 'APP_APP_DIR_NAME', 'app' );
define( 'APP_APP_HELPERS_DIR_NAME', 'helpers' );
define( 'APP_APP_SETUP_DIR_NAME', 'setup' );
define( 'APP_DIST_DIR_NAME', 'dist' );
define( 'APP_RESOURCES_DIR_NAME', 'resources' );
define( 'APP_THEME_DIR_NAME', 'theme' );
define( 'APP_VENDOR_DIR_NAME', 'vendor' );

define( 'APP_DIR', dirname( __DIR__ ) . DIRECTORY_SEPARATOR );
define( 'APP_APP_DIR', APP_DIR . APP_APP_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_APP_HELPERS_DIR', APP_APP_DIR . APP_APP_HELPERS_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_APP_SETUP_DIR', APP_APP_DIR . APP_APP_SETUP_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_DIST_DIR', APP_DIR . APP_DIST_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_RESOURCES_DIR', APP_DIR . APP_RESOURCES_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_THEME_DIR', APP_DIR . APP_THEME_DIR_NAME . DIRECTORY_SEPARATOR );
define( 'APP_VENDOR_DIR', APP_DIR . APP_VENDOR_DIR_NAME . DIRECTORY_SEPARATOR );

/**
 * Load composer dependencies.
 */
if ( file_exists( APP_VENDOR_DIR . 'autoload.php' ) ) {
	require_once APP_VENDOR_DIR . 'autoload.php';
}


// Require the composer autoload for getting conflict-free access to enqueue
require_once APP_VENDOR_DIR . '/autoload.php';

// Instantiate
$enqueue = new \WPackio\Enqueue( 'appName', 'outputPath', '1.0.0', 'theme', __FILE__ );




require_once APP_APP_DIR . 'index.php';