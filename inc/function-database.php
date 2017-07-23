<?php
/**
 * Database actionss.
 *
 * @package    wsa allotment
 * @subpackage Includes
 * @author     Bram Waasdorp <bram@waasdorpsoekhan.nl>
 * @copyright  Copyright (c)  2017, Bram Waasdorp
 * @link       https://github.com/bramwaas/wordpress-plugin-wsaallotment
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
# Add dbcheck.
add_action( 'plugins_loaded', 'wsaallotment_update_db_check' );
/**
 * Registers shortcodes.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
global $wsaallotment_db_version;
$wsaallotment_db_version = '0.1';

function wsaallotment_install_db() {
	// set tablenames with prefix  in a variable
	global $wpdb;
	$table_name_gardener  = $wpdb->prefix . "gardener";
	$table_name_allotment = $wpdb->prefix . "allotment";
	$charset_collate = $wpdb->get_charset_collate();
/**
 * Create statements following the picky rules of dbDelta
 * You must put each field on its own line in your SQL statement.
 * You must have two spaces between the words PRIMARY KEY and the definition of your primary key.
 * You must use the key word KEY rather than its synonym INDEX and you must include at least one KEY.
 * KEY must be followed by a SINGLE SPACE then the key name then a space then open parenthesis with the field name then a closed parenthesis.
 * You must not use any apostrophes or backticks around field names.
 * Field types must be all lowercase.
 * SQL keywords, like CREATE TABLE and UPDATE, must be uppercase.
 * You must specify the length of all fields that accept a length parameter. int(11), for example.
 */	
	$sql = "CREATE TABLE $table_name_gardener (
	gardener_id mediumint(9) NOT NULL AUTO_INCREMENT,
    user_login varchar(60),
	gardener_email varchar(100),
    initials varchar(10),
    infix varchar(20),
    last_name varchar(60) NOT NULL,
    first_name varchar(60),
	allotment_section varchar(1),
	allotment_nr tinyint(3),
	PRIMARY KEY  (gardener_id),
	UNIQUE KEY fk_user (user_login),
    KEY fk_allotment (allotment_section, allotment_nr)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	
	add_option( 'wsaallotment_db_version', $wsaallotment_db_version );
}
/**
 * Check on current  db-version . 
 * Update if not equal.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function wsaallotment_update_db_check() {
	global $wsaallotment_db_version;
	if ( get_site_option( 'wsaallotment_db_version' ) != $wsaallotment_db_version) {
		wsaallotment_install_db();
	}
}