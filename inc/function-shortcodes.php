<?php
/**
 * Shortcodes for use within posts and other shortcode-aware areas.
 *
 * @package    wsa allotment
 * @subpackage Includes
 * @author     Bram Waasdorp <bram@waasdorpsoekhan.nl>
 * @copyright  Copyright (c)  2017, Bram Waasdorp
 * @link       https://github.com/bramwaas/wordpress-plugin-wsaallotment
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
# Add shortcodes.
add_action( 'init', 'wsaallotment_register_shortcodes' );
/**
 * Registers shortcodes.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function wsaallotment_register_shortcodes() {
	// Add the `[view_gardener]` shortcode.
	add_shortcode( 'view_gardener', 'view_gardener_shortcode' );
	// Add the `[view_allotment]` shortcode.
	add_shortcode( 'view_allotment', 'view_allotment_shortcode' );
	// Add the `[update_gardeners]` shortcode.
	add_shortcode( 'update_gardeners', 'update_gardeners_shortcode' );
	// Add the `[update_allotments]` shortcode.
	add_shortcode( 'update_allotments', 'update_allotments_shortcode' );
	// Add the `[is_gardener]` shortcode.
	add_shortcode( 'is_gardener', 'is_gardener_shortcode' );
	// Add the `[not_gardener]` shortcode.
	add_shortcode( 'not_gardener', 'not_gardener_shortcode' );
	// Add the `[is_allotment-owner]` shortcode.
	add_shortcode( 'is_allotment_owner', 'is_allotment-owner_shortcode' );
	// Add the `[not_allotment-owner]` shortcode.
	add_shortcode( 'not_allotment_owner', 'not_allotment-owner_shortcode' );
}
/**
 * Check if email is is related to a gardener. 
 * Default email is email-address of logged in user.
 *
 * @since  0.1.0
 * @access public
 * @param  array   $attr
 * @param  string  $email
 * @return boolean
 */
function is_gardener( $email = null ) {
	
	return false;
}

/**
 * Check if email is is related to a allotment. 
 * Default email is email-address of logged in user.
 *
 * @since  0.1.0
 * @access public
 * @param  array   $attr
 * @param  string  $email
 * @return boolean
 */
function is_allotment( $email = null ) {
	
	return false;
}

/**
 * Displays content if the user viewing it is currently logged in and related to a gardener. 
 * This also blocks content from showing in feeds.
 *
 * @since  0.1.0
 * @access public
 * @param  array   $attr
 * @param  string  $content
 * @return string
 */
function is_gardener_shortcode( $attr, $content = null ) {
	return is_feed() || ! is_gardener() || is_null( $content ) ? '' : do_shortcode( $content );
}
/**
 * Displays content if the user viewing it is not currently logged in or not related to a gardener.
 *
 * @since  0.1.0
 * @access public
 * @param  array   $attr
 * @param  string  $content
 * @return string
 */
function not_gardener_shortcode( $attr, $content = null ) {
	return is_gardener() || is_null( $content ) ? '' : do_shortcode( $content );
}
/**
 * Displays content if the user viewing it is currently logged in and related to an allotment. 
 * This also blocks content from showing in feeds.
 *
 * @since  0.1.0
 * @access public
 * @param  array   $attr
 * @param  string  $content
 * @return string
 */
function is_allotment_owner_shortcode( $attr, $content = null ) {
	return is_feed() || ! is_allotment_owner() || is_null( $content ) ? '' : do_shortcode( $content );
}
/**
 * Displays content if the user viewing it is not currently logged in or not related to an allotment.
 *
 * @since  0.1.0
 * @access public
 * @param  array   $attr
 * @param  string  $content
 * @return string
 */
function not_allotment_owner_shortcode( $attr, $content = null ) {
	return is_allotment_owner() || is_null( $content ) ? '' : do_shortcode( $content );
}

/**
 * Displays a view gardener form.
 *
 * @since  0.1.0
 * @access public
 * @return string
 */
function view_gardener_shortcode($attr, $content = null) {
	$content = 'Geen user gevonden';
        $current_user = wp_get_current_user(); 
        if ( ( $current_user instanceof WP_User ) ) {
        	$row = wsaallotment_get_gardener_row ($current_user->user_login);
		$content = wsaallotment_view_gardener ($row) ;
	}
 	return $content;
}
/**
 * Displays a gardener row in a table.
 *
 * @since  0.1.0
 * @access public
 * @return string
 */
function wsaallotment_view_gardener ($row = null) {
	$labels = wsaallotment_gardener_labels ();	
   	$content = '
<table class="table wp-list-table widefat fixed">';
   	foreach($row as $field => $value) { 
               $content .= '
		<tr>
			<th scope="row" class="ss-th-width">' . $labels[$field] . '</th>
			<td  class="ss-field-width">' . $value . '</td>
		</tr>';
        	}
            $content .= '
</table>';
	    return $content;
}
	
/**
 * Displays a view allotment form.
 *
 * @since  0.1.0
 * @access public
 * @return string
 */
function view_allotment_shortcode($attr, $content = null) {
	$content = 'Geen user gevonden';
        $current_user = wp_get_current_user(); 
        if ( ( $current_user instanceof WP_User ) ) {
         	$content = __('Voorlopig alleen email van tuintje: ', 'wsaallotment') . esc_html( $current_user->user_email );
	}
 	return $content;
}
