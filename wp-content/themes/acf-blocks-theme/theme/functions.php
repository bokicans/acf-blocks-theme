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
define( 'APP_APP_DIR_NAME', 'inc' );
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

echo APP_THEME_DIR;


// Require the composer autoload for getting conflict-free access to enqueue
require_once APP_VENDOR_DIR. 'autoload.php';

// Instantiate
//$enqueue = new \WPackio\Enqueue( 'acfBlocksTheme', '../dist', '1.0.0', 'theme', APP_DIST_DIR );


// Do stuff through this plugin
class themeInit {
	/**
	 * @var \WPackio\Enqueue
	 */
	public $enqueue;

	public function __construct() {
		// It is important that we init the Enqueue class right at the plugin/theme load time
		$this->enqueue = new \WPackio\Enqueue(
			// Name of the project, same as `appName` in wpackio.project.js
			'acfBlocksTheme',
			// Output directory, same as `outputPath` in wpackio.project.js
			'../dist',
			// Version of your plugin
			'1.0.0',
			// Type of your project, same as `type` in wpackio.project.js
			'theme',
			// Plugin location, pass false in case of theme.
			APP_DIST_DIR
		);
		// Enqueue a few of our entry points
		add_action( 'wp_enqueue_scripts', [ $this, 'plugin_enqueue' ] );
	}

	public function plugin_enqueue() {
		// Enqueue files[0] (name = app) - entryPoint main
		$this->enqueue->enqueue( 'app', 'main', [] );
	}
}


// Init
new themeInit();





require_once APP_APP_DIR . 'index.php';