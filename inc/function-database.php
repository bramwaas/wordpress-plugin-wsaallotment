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
/**
 * Registers shortcodes.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */

function wsaallotment_install_db() {
	// include upgrade db functions
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	// set tablenames with prefix  in a variable
	global $wsaallotment_db_version;
	$wsaallotment_db_version = '0.1.0';
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
    gardener_initials varchar(10),
    gardener_infix varchar(20),
    gardener_last_name varchar(100) NOT NULL,
    gardener_first_name varchar(60),
	allotment_section varchar(1),
	allotment_nr tinyint(3),
	PRIMARY KEY  (gardener_id),
	UNIQUE KEY fk_user (user_login),
	UNIQUE KEY uk_email (gardener_email),
    KEY fk_allotment (allotment_section, allotment_nr)
	) $charset_collate;";
	
	dbDelta( $sql ); // concatenate  in one string with .= for a single call
	
	$sql = "CREATE TABLE $table_name_allotment (
	allotment_id mediumint(9) NOT NULL AUTO_INCREMENT,
	allotment_section varchar(1) NOT NULL,
	allotment_nr tinyint(3) NOT NULL,
	allotment_contribution decimal(8,2),
	allotment_insurance decimal(8,2),
	allotment_insured decimal(10,2),
	allotment_description text,
	PRIMARY KEY  (allotment_id),
	UNIQUE KEY uk_allotment (allotment_section, allotment_nr)
	) $charset_collate;";
	
	dbDelta( $sql );
	// set option for this version of db-tables
	update_option( 'wsaallotment_db_version', $wsaallotment_db_version );
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
/**
 * Give the fields for table gardener without the id with empty value. 
 * 
 *
 * @since  0.1.0
 * @access public
 * @return array A
 */
function wsaallotment_gardener_fields () {
    	return array(
			'user_login' => null,
			'gardener_email' => null,
			'gardener_initials' => null,
			'gardener_infix' => null,
			'gardener_last_name' => null,
			'gardener_first_name' => null,
			'allotment_section' => null,
			'allotment_nr' => null); 
}
/**
 * Give the fields for table gardener with transaltable labelname . 
 * 
 *
 * @since  0.1.0
 * @access public
 * @return array A
 */
function wsaallotment_gardener_labels () {
		return array('gardener_id' => __('Id' , 'wsaallotment'),
			'user_login' => __('Login' , 'wsaallotment'),
			'gardener_email' => __('Email' , 'wsaallotment'),
			'gardener_initials' => __('Initials' , 'wsaallotment'),
			'gardener_infix' => __('Infix' , 'wsaallotment'),
			'gardener_last_name' => __('Last name' , 'wsaallotment'),
			'gardener_first_name' => __('First name' , 'wsaallotment'),
			'allotment_section' => __('Section' , 'wsaallotment'),
			'allotment_nr' => __('Nr' , 'wsaallotment')); 
	
}
/**
 * Single gardener row on user_login
 *
 * @since  0.1.0
 * @access public
 * @return array
 */
function wsaallotment_get_gardener_row ($user_login) {
	global $wpdb;
	$table_name = $wpdb->prefix . "gardener";
    	$fields = wsaallotment_gardener_fields ();
	$labels = wsaallotment_gardener_labels ();
        $select_list = implode(", ", array_keys($fields)) ;
 	$sql = $wpdb->prepare("SELECT $select_list from $table_name WHERE user_login=%s", $user_login);
    	return $wpdb->get_row($sql, ARRAY_A); ?>
}
