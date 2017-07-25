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
        $gardener_id = $_POST["gardener_id"];
        $user_login= $_POST["user_login"];
        $gardener_email= $_POST["gardener_email"];
        $gardener_initials= $_POST["gardener_initials"];
        $gardener_infix= $_POST["gardener_infix"];
        $gardener_last_name= $_POST["gardener_last_name"];
        $gardener_first_name= $_POST["gardener_first_name"];
        $allotment_section= $_POST["allotment_section"];
        $allotment_nr= $_POST["allotment_nr"];
        $wpdb->insert(
                $table_name, //table
        		array('gardener_id' => $gardener_id,
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
        $message.="gardener inserted";
    }
    ?>
    <link type="text/css" href="<?php echo plugin_dir_url(  __FILE__ ). 'css/style-admin.css' ?>" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New gardener</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <p>Three capital letters for the ID</p>
            <table class="table wp-list-table widefat fixed">
                <tr>
                    <th scope="row" class="ss-th-width">ID</th>
                    <td><input type="text" name="gardener_id" value="<?php echo $gardener_id; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Login</th>
                    <td><input type="text" name="user_login" value="<?php echo $user_login; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Email</th>
                    <td><input type="text" name="gardener_email" value="<?php echo $gardener_email; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Initials</th>
                    <td><input type="text" name="gardener_initials" value="<?php echo $gardener_initials; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Infix</th>
                    <td><input type="text" name="gardener_infix" value="<?php echo $gardener_infix; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">LastName</th>
                    <td><input type="text" name="gardener_last_name" value="<?php echo $gardener_last_name; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">FirstName</th>
                    <td><input type="text" name="gardener_first_name" value="<?php echo $gardener_first_name; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Section</th>
                    <td><input type="text" name="allotment_section" value="<?php echo $allotment_section; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Nr</th>
                    <td><input type="text" name="allotment_nr" value="<?php echo $allotment_nr; ?>" class="ss-field-width" /></td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}
