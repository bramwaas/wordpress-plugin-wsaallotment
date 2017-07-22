<?php
/*
Plugin Name: wsa allotment
Plugin URI:  http://www.waasdorpsoekhan.nl/wsaallotment
Description: Wordpress plugin for management of allotment entities. Designed for Volkstuinvereniging Linnaeus.
Version:     0.1
Author:      Bram Waasdorp
Author URI:  https://www.waasdorpsoekhan.nl/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wsaallotment
Domain Path: /languages

this program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
this program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with this program. If not, see https://www.gnu.org/licenses/gpl-2.0.html
* @package   wsa allotment
* @version   0.1.0
* @author    Bram Waasdorp <bram@waasdorpsoekhan.nl>
* @copyright Copyright (c) 2017, Bram Waasdorp
* @link      http://www.waasdorpsoekhan.nl/wsaallotment
* @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

*/
// If this file is called directly, abort.
defined( 'ABSPATH' ) or die;
/**
 * Singleton class for setting up the plugin.
 *
 * @since  0.1.0
 * @access public
 */
final class WsaAllotment_Plugin {
	/**
	 * Minimum required PHP version.
	 *
	 * @since  0.1.0
	 * @access public
	 * @var    string
	 */
	private $php_version = '5.3.0';
	/**
	 * Plugin directory path.
	 *
	 * @since  0.1.0
	 * @access public
	 * @var    string
	 */
	public $dir = '';
	/**
	 * Plugin directory URI.
	 *
	 * @since  0.1.0
	 * @access public
	 * @var    string
	 */
	public $uri = '';

	/**
	 * Returns the instance.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return object
	 */

	/**
	 * Sets up globals.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return void
	 */
	private function setup() {
		// Main plugin directory path and URI.
		$this->dir = trailingslashit( plugin_dir_path( __FILE__ ) );
		$this->uri  = trailingslashit( plugin_dir_url(  __FILE__ ) );
	}

	/**
	 * Loads files needed by the plugin.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return void
	 */
	private function includes() {
		// Load class files.
//		require_once( $this->dir . 'inc/class-capability.php' );
		// Load includes files.
		require_once( $this->dir . 'inc/function-shortcodes.php'                     );
		// Load template files.
//		require_once( $this->dir . 'inc/template.php' );
		// Load admin files.
		if ( is_admin() ) {
			// General admin functions.
//			require_once( $this->dir . 'admin/functions-admin.php' );
			// Plugin settings.
//			require_once( $this->dir . 'admin/class-settings.php' );
		}
	}
	
	
	public static function get_instance() {
		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup();
			$instance->includes();
			$instance->setup_actions();
		}
		return $instance;
	}

	/**
	 * Sets up main plugin actions and filters.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {
		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );
		// Register activation hook.
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
	}
	/**
	 * Loads the translation files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function i18n() {
		load_plugin_textdomain( 'wsaallotment', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) . 'language' );
	}
}
	
/**
 * Gets the instance of the `WsaAllotment_Plugin` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return object
 */
function wsaallotment_plugin() {
	return WsaAllotment_Plugin::get_instance();
}
// Start
wsaallotment_plugin();
