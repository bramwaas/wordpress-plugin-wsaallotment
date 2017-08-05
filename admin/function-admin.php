<?php
/**
 * Admin menus
 *
 * @package    wsa allotment
 * @subpackage Admin
 * @author     Bram Waasdorp <bram@waasdorpsoekhan.nl>
 * @copyright  Copyright (c)  2017, Bram Waasdorp
 * @link       https://github.com/bramwaas/wordpress-plugin-wsaallotment
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
/**
 * Roles and capabillity for this plugin
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
//
//menu items
function wsaallotment_gardeners_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page(__('Allotments', 'wsaallotment'), //page title
			__('Allotments', 'wsaallotment'), //menu title
			'member_administration', //capabilities
			'wsaallotment_allotments_list', //menu slug
			'wsaallotment_allotments_list' //function
			);
	add_submenu_page('wsaallotment_allotments_list', //parent slug
			__('Gardeners', 'wsaallotment'), //page title
 			__('Gardeners', 'wsaallotment'), //menu title
			'member_administration', //capabilities
			'wsaallotment_gardeners_list', //menu slug
			'wsaallotment_gardeners_list' //function
			);
	
	//this is a submenu
	add_submenu_page('wsaallotment_allotments_list', //parent slug
			__('Add new allotment', 'wsaallotment'), //page title 
			__('Add new allotment', 'wsaallotment'), //menu title
			'member_administration', //capability
			'wsaallotment_allotment_create', //menu slug
			'wsaallotment_allotment_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
			__('Update allotment', 'wsaallotment'), //page title
			__('Update', 'wsaallotment'), //menu title
			'member_administration', //capability
			'wsaallotment_allotment_update', //menu slug
			'wsaallotment_allotment_update'); //function
	//this is a submenu
	add_submenu_page('wsaallotment_allotments_list', //parent slug
					__('Add new gardener', 'wsaallotment'), //page title
					__('Add new gardener', 'wsaallotment'), //menu title
					'member_administration', //capability
					'wsaallotment_gardener_create', //menu slug
					'wsaallotment_gardener_create'); //function
					
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
					__('Update gardener', 'wsaallotment'), //page title
			__('Update', 'wsaallotment'), //menu titlemanage_options
					'member_administration', //capability
					'wsaallotment_gardener_update', //menu slug
					'wsaallotment_gardener_update'); //function
							
}

