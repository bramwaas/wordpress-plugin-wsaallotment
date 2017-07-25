<?php
/**
 * Admin Gardener create
 *
 * @package    wsa allotment
 * @subpackage Admin
 * @author     Bram Waasdorp <bram@waasdorpsoekhan.nl>
 * @copyright  Copyright (c)  2017, Bram Waasdorp
 * @link       https://github.com/bramwaas/wordpress-plugin-wsaallotment
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
/**
 * Admin create view on gardener
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
/*
 * 	gardener_id mediumint(9) NOT NULL AUTO_INCREMENT,
    user_login varchar(60),
	gardener_email varchar(100),
    gardener_initials varchar(10),
    gardener_infix varchar(20),
    gardener_last_name varchar(100) NOT NULL,
    gardener_first_name varchar(60),
	allotment_section varchar(1),
	allotment_nr tinyint(3),

 */
function wsaallotment_gardener_create() {
	//insert
	global $wpdb;
	$table_name = $wpdb->prefix . "gardener";
	if (isset($_POST['insert'])) {
		$user_login= (($_POST["user_login"])> ' ') ? $_POST["user_login"] : null;
		$gardener_email= (($_POST["gardener_email"])> ' ') ? $_POST["gardener_email"] : null;
		$gardener_initials= $_POST["gardener_initials"];
		$gardener_infix= $_POST["gardener_infix"];
		$gardener_last_name=  ($_POST["gardener_last_name"]> ' ') ? $_POST["gardener_last_name"] : null;
		$gardener_first_name=  $_POST["gardener_first_name"];
		$allotment_section= (($_POST["allotment_section"])> ' ') ? $_POST["allotment_section"] : null;
		$allotment_nr= (($_POST["allotment_nr"])> ' ') ? $_POST["allotment_nr"] : null;
        $wpdb->insert(
                $table_name, //table
        		array(
        				'user_login' => $user_login,
        				'gardener_email' => $gardener_email,
        				'gardener_initials' => $gardener_initials,
        				'gardener_infix' => $gardener_infix,
        				'gardener_last_name' => $gardener_last_name,
        				'gardener_first_name' => $gardener_first_name,
        				'allotment_section' => $allotment_section,
        				'allotment_nr' => $allotment_nr), //data
        		array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d') //data format			
        );
        if (! isset($message)) { $message="gardener inserted ";}
    }
    ?>
    <link type="text/css" href="<?php echo plugin_dir_url(  __FILE__ ). '../css/style-admin.css' ?>" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New gardener</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
             <table class="table wp-list-table widefat fixed">
                <tr>
                    <th scope="row" class="ss-th-width">Login</th>
                    <td><input type="text" name="user_login" value="" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Email</th>
                    <td><input type="text" name="gardener_email" value="" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Initials</th>
                    <td><input type="text" name="gardener_initials" value="" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Infix</th>
                    <td><input type="text" name="gardener_infix" value="" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Last name</th>
                    <td><input type="text" name="gardener_last_name" value="" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">First name</th>
                    <td><input type="text" name="gardener_first_name" value="" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Section</th>
                    <td><input type="text" name="allotment_section" value="" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Nr</th>
                    <td><input type="text" name="allotment_nr" value="" class="ss-field-width" /></td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}
