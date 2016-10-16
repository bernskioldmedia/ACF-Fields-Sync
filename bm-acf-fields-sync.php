<?php
/**
 * Plugin Name: ACF Fields Sync
 * Plugin URI:  https://www.bernskioldmedia.com/en/products/acf-fields-sync/
 * Description: Stores the local JSON files for ACF inside this plugin directory instead of as default with ACF in an active theme.
 * Version:     1.0.1
 * Author:      Bernskiold Media
 * Author URI:  https://www.bernskioldmedia.com
 * Text Domain: bm-acf-fields-sync
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace ACF_Fields_Sync;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class ACF_Fields_Sync
 *
 * Main plugin class used for everything in this little plugin.
 *
 * @package ACF_Fields_Sync
 */
class ACF_Fields_Sync {

	/**
	 * Plugin URL
	 *
	 * @var string
	 */
	public $plugin_url = '';

	/**
	 * Plugin Directory Path
	 *
	 * @var string
	 */
	public $plugin_dir = '';

	/**
	 * Plugin Version Number
	 *
	 * @var string
	 */
	public $plugin_version = '';

	/**
	 * Plugin Class Instance Variable
	 *
	 * @var object
	 */
	protected static $_instance = null;

	/**
	 * Plugin Instantiator
	 *
	 * @return object
	 */
	public static function get_instance() {

	    if ( is_null( self::$_instance ) ) {
	    	self::$_instance = new self();
	    }

		return self::$_instance;

	}

	public function __construct() {

		// Set Plugin Version.
		$this->plugin_version = '1.0.1';

		// Set plugin Directory.
		$this->plugin_dir = untrailingslashit( plugin_dir_path( __FILE__ ) );

		// Set Plugin URL.
		$this->plugin_url = untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) );

		// Load Translations.
		add_action( 'plugins_loaded', array( $this, 'languages' ) );

		/**
		 * If ACF isn't installed, we show a notice to the user to
		 * alert them of this dependency.
		 *
		 * If it is installed however, we just add the filters and
		 * get on with our life.
		 */
		if ( ! class_exists( 'acf' ) ) {
			add_action( 'admin_notices', array( $this, 'show_acf_install_notice' ) );
		} else {

			// Hook into the filters.
			add_filter( 'acf/settings/save_json', array( $this, 'acf_json_save' ) );
			add_filter( 'acf/settings/load_json', array( $this, 'acf_json_load' ) );

		}

	}

	/**
	 * Show ACF Install Notice
	 *
	 * Creates the admin notice which will be shown to the user
	 * in the event that the ACF plugin itself is not installed
	 * and this plugin will not be run.
	 *
	 * @return void
	 */
	public function show_acf_install_notice() {

		// Admin Notice Classes.
		$class = 'notice notice-error is-dismissable';

		// Admin Notice Message.
		$message = __( 'ACF Not Active. For the ACF Fields Sync plugin to work, you need to have the ACF plugin activated too.', 'bm-acf-fields-sync' );

		// Create the message.
		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );

	}

	/**
	 * Modify ACF JSON Save Folder
	 *
	 * @return string
	 */
	public function acf_json_save() {

		// update path
		$path = dirname( __FILE__ ) . '/json';

		return $path;

	}

	/**
	 * Make ACF recognize custom JSON folder for loading
	 *
	 * @param array $paths Array of loading paths.
	 *
	 * @return array
	 */
	function acf_json_load( $paths ) {

		// append path
		$paths[] = dirname( __FILE__ ) . '/json';

		return $paths;

	}

	/**
	 * Load Translations
	 *
	 * @return void
	 */
	public function languages() {

		load_plugin_textdomain( 'bm-acf-fields-sync', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

}

/**
 * Create the Plugin Instance
 */
function bm_acf_fields_sync() {
    return ACF_Fields_Sync::get_instance();
}

// Initialize the class instance only once.
bm_acf_fields_sync();