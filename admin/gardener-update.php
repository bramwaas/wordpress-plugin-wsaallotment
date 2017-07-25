<?php
/**
 * Admin Gardener delete
 *
 * @package    wsa allotment
 * @subpackage Admin
 * @author     Bram Waasdorp <bram@waasdorpsoekhan.nl>
 * @copyright  Copyright (c)  2017, Bram Waasdorp
 * @link       https://github.com/bramwaas/wordpress-plugin-wsaallotment
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
/**
 * Admin delete view on gardener
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function wsaallotment_gardener_update() {
    global $wpdb;
    //update
    $table_name = $wpdb->prefix . "gardener";
    $gardener_id= $_GET["gardener_id"];
    if (isset($_POST['update'])) {
     	$user_login= $_POST["user_login"];
    	$gardener_email= $_POST["gardener_email"];
    	$gardener_initials= $_POST["gardener_initials"];
    	$gardener_infix= $_POST["gardener_infix"];
    	$gardener_last_name= $_POST["gardener_last_name"];
    	$gardener_first_name= $_POST["gardener_first_name"];
    	$allotment_section= $_POST["allotment_section"];
    	$allotment_nr= $_POST["allotment_nr"];
    	$wpdb->update(
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
        		array('gardener_id' => $gardener_id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
    	$sql= $wpdb->prepare("DELETE FROM $table_name WHERE gardener_id = %s", $gardener_id);
    	$wpdb->query($sql);
    	$message.="gardener inserted";
    } else {//selecting value to update	
    	$sql = $wpdb->prepare("SELECT gardener_id,user_login,gardener_email,gardener_initials,gardener_infix,gardener_last_name,gardener_first_name,allotment_section,allotment_nr from $table_name where gardener_id=%s", $gardener_id);
    	$row = $wpdb->get_row($sql, ARRAY_A);

    }
    ?>
   <link type="text/css" href="<?php echo plugin_dir_url(  __FILE__ ). 'css/style-admin.css' ?>" rel="stylesheet" />
    <div class="wrap">
        <h2>gardeners</h2>

        <?php if (isset($_POST['delete'])){ ?>
            <div class="updated"><p>gardener deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=wsaallotment_gardeners_list') ?>">&laquo; Back to gardeners list</a>

        <?php } else if (isset($_POST['update'])){ ?>
            <div class="updated"><p>gardener updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=wsaallotment_gardeners_list') ?>">&laquo; Back to gardeners list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class="table wp-list-table widefat fixed">
                <tr>
                    <th class="ss-th-width">Login</th>
                    <td><input type="text" name="user_login" value="<?php echo $row['user_login']; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Email</th>
                    <td><input type="text" name="gardener_email" value="<?php echo $row['gardener_email']; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Initials</th>
                    <td><input type="text" name="gardener_initials" value="<?php echo $row['gardener_initials']; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Infix</th>
                    <td><input type="text" name="gardener_infix" value="<?php echo $row['gardener_infix']; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">LastName</th>
                    <td><input type="text" name="gardener_last_name" value="<?php echo $row['gardener_last_name']; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">FirstName</th>
                    <td><input type="text" name="gardener_first_name" value="<?php echo $row['gardener_first_name']; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Section</th>
                    <td><input type="text" name="allotment_section" value="<?php echo $row['allotment_section']; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th scope="row" class="ss-th-width">Nr</th>
                    <td><input type="text" name="allotment_nr" value="<?php echo $row['allotment_nr']; ?>" class="ss-field-width" /></td>
                </tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('&iquest;Est&aacute;s seguro de borrar este elemento?')">
            </form>
        <?php } ?>

    </div>
    <?php
}
