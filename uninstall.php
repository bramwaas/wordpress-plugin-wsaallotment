<?php
/**
 * Uninstall actions.
 *
 * @package    wsa allotment
 * @subpackage 
 * @author     Bram Waasdorp <bram@waasdorpsoekhan.nl>
 * @copyright  Copyright (c)  2017, Bram Waasdorp
 * @link       https://github.com/bramwaas/wordpress-plugin-wsaallotment
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
global $wpdb;
$table_name_gardener  = $wpdb->prefix . "gardener";
$table_name_allotment = $wpdb->prefix . "allotment";
 
$option_name = 'wsaallotment_db_version';
 
delete_option($option_name);

// drop custom database tables

$wpdb->query("DROP TABLE IF EXISTS $table_name_gardener");
$wpdb->query("DROP TABLE IF EXISTS $table_name_allotment");
