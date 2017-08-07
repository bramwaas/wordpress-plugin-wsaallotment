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
							
			add_submenu_page('wsaallotment_allotments_list', //parent slug
					__('Info', 'wsaallotment'), //page title
					__('Info', 'wsaallotment'), //menu title
					'member_administration', //capability
					'wsaallotment_info', //menu slug
					'wsaallotment_info'); //function
					
}
function wsaallotment_info () {
//
	echo('<div class="wrap">');
	_e('<h2>Info</h2><p>', 'wsaallotment');
	
	_e('<strong>Af te sluiten shortcodes.</strong></p><p>', 'wsaallotment');
	
	_e('Formaat: [shortcode]...te bewerken tekst ...[/shortcode]</p><p>', 'wsaallotment');
	
	_e('De tekst tussen de beginshortcode [shortcode] en de eindshortcode [/shortcode] wordt bewerkt. In deze plugin wordt de inhoud al of niet getoond.</p><p>', 'wsaallotment');
	
	_e('<strong>Voorbeelden:</strong></p><p>', 'wsaallotment');
	
	_e('<strong>is_gardener:</strong></p><p>', 'wsaallotment');
	
	_e('[is_gardener]toont deze info als gebruiker een tuinder is[/is_gardener]</p><p>', 'wsaallotment');
	
	_e('<strong>not_gardener</strong>:</p><p>', 'wsaallotment');
	
	_e('[not_gardener]toont deze info als gebruiker een tuinder is, of niet ingelogd[/not_gardener]</p><p>', 'wsaallotment');
	
	_e('<strong>has_allotment</strong>:</p><p>', 'wsaallotment');
	
	_e('[has_allotment]toont deze info als gebruiker een tuinder is en een tuintje heeft[/has_allotment]</p><p>', 'wsaallotment');
	
	_e('<strong>not_allotment</strong>:</p><p>', 'wsaallotment');
	
	_e('[not_allotment]toont deze info als gebruiker niet een tuinder is of geen tuintje heeft[/not_allotment]</p><p>', 'wsaallotment');
	
	_e('<strong>Eenvoudige shortcodes.</strong></p><p>', 'wsaallotment');
	
	_e('Formaat [shortcode]</p><p>', 'wsaallotment');
	
	_e('de shortcode wordt vervangen door een inhoud.</p><p>', 'wsaallotment');
	
	_e('<strong>Voorbeelden:</strong></p><p>', 'wsaallotment');
	
	_e('<strong>view_gardener,</p><p>', 'wsaallotment');
	_e('</strong>toont de gegevens die wij van deze tuinder hebben geadministreerd:</p><p>', 'wsaallotment');
	
	_e('[view_gardener]</p><p>', 'wsaallotment');
	
	_e('<strong>view_allotment,</p><p>', 'wsaallotment');
	_e('</strong>toont de gegevens die wij van de volkstuin van deze tuinder hebben geadministreerd:</p><p>', 'wsaallotment');
	_e('[view_allotment]</p><p>', 'wsaallotment');

	echo('</p></div>');
	
	
	
	
}

