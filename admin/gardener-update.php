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
    if (current_user_can('member_administration'   )) {

    global $wpdb;
    //update
    $table_name = $wpdb->prefix . "gardener";
    $fields = wsaallotment_gardener_fields ();
    $labels = wsaallotment_gardener_labels ();
    $select_list = implode(", ", array_keys($fields));
    if (isset($_GET['gardener_id'])) {
    $gardener_id= $_GET['gardener_id'];
    if (isset($_POST['update'])) {
    	foreach($_POST as $field => $value) {
    		if ($field=='update') {}
    		else {$fields[$field] = ($value > ' ') ? $value : null;}
    	}
    	$wpdb->update(
                $table_name, //table
    			$fields, //data
        		array('gardener_id' => $gardener_id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    	if (! isset($message)) { $message = __('Gardener updated', 'wsaallotment');}
     }
//delete
    else if (isset($_POST['delete'])) {
    	$sql= $wpdb->prepare("DELETE FROM $table_name WHERE gardener_id = %s", $gardener_id);
    	$wpdb->query($sql);
    	unset($fields);
    	if (! isset($message)) { $message = __('Gardener deleted', 'wsaallotment');}
    } else {//selecting row to update	
    	$sql = $wpdb->prepare("SELECT $select_list FROM $table_name WHERE gardener_id=%s", $gardener_id);
    	$fields = $wpdb->get_row($sql, ARRAY_A);

    }
    } // end  if (isset($_GET['gardener_id']))
    else {
    	if (isset($message))  { $message .= ' ' . __('Id missing', 'wsaallotment');}
    	    else { $message = __('Id missing', 'wsaallotment');}
    	
    }
    ?>
   <link type="text/css" href="<?php echo plugin_dir_url(  __FILE__ ). 'css/style-admin.css' ?>" rel="stylesheet" />
    <div class="wrap">
         <h2><?php _e('Gardener', 'wsaallotment'); ?></h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div>
                  <a href="<?php echo admin_url('admin.php?page=wsaallotment_gardeners_list') ?>">&laquo; <?php _e('Back to the gardeners list', 'wsaallotment'); ?></a>
        <?php endif; ?>

        <?php if (isset($fields)) { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
             <table class="table wp-list-table widefat fixed">
        	<?php
        	foreach($fields as $field => $value) { ?>
               <tr>
                    <th scope="row" class="ss-th-width"><?php echo $labels[$field]; ?></th>
                    <td><input type="text" name="<?php echo $field; ?>" value="<?php echo $value; ?>" class="ss-field-width" /></td>
                </tr>
        		
        	<?php	
        	}
        	?>
            </table>
                <input type='submit' name="update" value='<?php _e('Save', 'wsaallotment'); ?>' title="<?php _e('Update gardener', 'wsaallotment'); ?>" class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='<?php _e('Delete', 'wsaallotment'); ?>' title="<?php _e('Delete gardener', 'wsaallotment'); ?>" class='button' onclick="return confirm('<?php _e('Delete this gardener?','wsaallotment')?>')">
            </form>
        <?php } ?>

    </div>
    <?php
}
}
else {echo '<div class="wrap">';
    _e('User is not authorised for this function','wsaallotment');
     echo '</div>';}
    
