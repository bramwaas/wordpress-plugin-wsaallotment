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
 * 20170811    section table toegevoegd
 */
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
// remove roles and capabillities added by this plugin.
wsaallotment_memberadministration_role_remove();

// drop custom database tables created by this plugin
global $wpdb;
$table_name_gardener  = $wpdb->prefix . "gardener";
$table_name_allotment = $wpdb->prefix . "allotment";
$table_name_section = $wpdb->prefix . "section";

$wpdb->query("DROP TABLE IF EXISTS $table_name_gardener");
$wpdb->query("DROP TABLE IF EXISTS $table_name_allotment");
$wpdb->query("DROP TABLE IF EXISTS $table_name_section");
//remove options added by this plugin 
$option_name = 'wsaallotment_db_version';
delete_option($option_name);
$option_name = 'wsaallotment_version';
delete_option($option_name);
