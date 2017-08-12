<?php
/*
Plugin Name: Wsa Allotment
Plugin URI:  https://github.com/bramwaas/wordpress-plugin-wsaallotment
Description: Wordpress plugin for management of allotment entities. Designed for Volkstuinvereniging Linnaeus.
Version:     0.2.0
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
* @version   0.2.0
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
	 * Plugin directory
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
		$this->dir =  plugin_dir_path( __FILE__ );
		$this->uri =  plugin_dir_url(  __FILE__ ); 
	}


/**
 * Check on current  version . 
 * Update if not equal.
 *
 * @since  0.2.0
 * @access public
 * @return void
 */
function wsaallotment_update_version_check() {
	$wsaallotment_version = '0.2.0';
	wsaallotment_update_db_check();
	if ( get_site_option( 'wsaallotment_version' ) != $wsaallotment_version) {
		update_option( 'wsaallotment_version', $wsaallotment_version );
	}
}
	/**
	 * Loads files needed by the plugin.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return void
	 */
	private function includes() {
		// Load class files. for general use
		// Load includes files.
		require_once( $this->dir . 'inc/function-shortcodes.php'                     );
		require_once( $this->dir . 'inc/function-database.php'                       );
		// Load template files.
//		require_once( $this->dir . 'inc/template.php' );
		// Load admin files.
		if ( is_admin() ) {
			// General admin functions. ! only for admin nu for general use
			require_once( $this->dir . 'admin/function-admin.php' );
			// Plugin settings.
//			require_once( $this->dir . 'admin/class-settings.php' );
			// CRUD on gardener and allotment
		    require_once( $this->dir . 'admin/allotment-crud.php');
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
		// Add shortcodes.
		add_action( 'init', 'wsaallotment_register_shortcodes' );
		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );
		// Add dbcheck and plugin version check.
		add_action( 'plugins_loaded', array($this,'wsaallotment_update_version_check'));
		// add the wsaallotment_memberadministration_role
		add_action('plugins_loaded', array($this, 'wsaallotment_member_admin_role'));
		// CRUD actions in admin-menu
		add_action('admin_menu','wsaallotment_admin_modifymenu');
		// Register activation hook.
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		// uninstall via uninstall.php
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
	
	/**
	 * Adds Roles for this plugin
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function wsaallotment_member_admin_role() {
		add_role(
				'wsaallotment_member_administration',
				__('Member Administration','wsaallotment'),
				[
						'read'         => true,
						'member_administration'   => true,
				]
				);
	}
	
	
	/**
	 * Remove Roles for this plugin
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	
	public function wsaallotment_memberadministration_role_remove()
	{
		remove_role('wsaallotment_member_administration');
	}
	/**
	 * Crud menu on gardener
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	
	
	/**
	 * Method that runs only when the plugin is activated.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function activation() {
		// Create db-tables
		wsaallotment_install_db();
	}

	/**
	 * Magic method to output a string if trying to use the object as a string.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __toString() {
		return 'Wsa Allotment';
	}
	/**
	 * Magic method to keep the object from being cloned.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'wsaallotment' ), '1.0.0' );
	}
/**
	 * Magic method to keep the object from being unserialized.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'wsaallotment' ), '1.0.0' );
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
