<?php
/**
 * Admin Gardeners list
 *
 * @package    wsa allotment
 * @subpackage Admin
 * @author     Bram Waasdorp <bram@waasdorpsoekhan.nl>
 * @copyright  Copyright (c)  2017, Bram Waasdorp
 * @link       https://github.com/bramwaas/wordpress-plugin-wsaallotment
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
/**
 * Crud menu on gardener
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function wsaallotment_gardeners_list() {
    ?>
    <link type="text/css" href="<?php echo plugin_dir_url(  __FILE__ ) . 'css/style-admin.css' ?>" rel="stylesheet" />
    <div class="wrap">
        <h2>gardeners</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=wsaallotment_gardener_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "gardener";
    	$fields = wsaallotment_gardener_fields ();
	$labels = wsaallotment_gardener_labels ();
        $select_list = implode(", ", array_keys($fields)) . ', gardener_id ';
        $rows = $wpdb->get_results("SELECT $select_list from $table_name");
         ?>
        <table class='table table-striped wp-list-table widefat fixed striped posts'>
            <thead>
            <tr>
	    <?php foreach ($fields as $field => $value) { ?>	    
                <th class="manage-column ss-list-width"><?php echo $labels[$field]; ?></th>
		<?php 	}  ?>    
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $fields) { ?>
                <tr>
		<?php foreach ($fields as $field => $value) { 
		 	if ($field !== 'gardener_id'){ 
				if ($field === 'gardener_last_name'){ ?>
                    	<td class="manage-column ss-list-width"><a 
				href="<?php echo admin_url('admin.php?page=wsaallotment_gardener_update&gardener_id=' . $fields['gardener_id']);
				?>"><?php echo $fields['gardener_last_name'];?></a></td>
	              <?php } 	else { ?>
                    <td class="manage-column ss-list-width"><?php echo $value; ?></td>
 		        <?php 	} 
			  }
         		} ?>		
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
}
