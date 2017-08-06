<?php
/**
 * Admin Allotment Crud
 *
 * @package    wsa allotment
 * @subpackage Admin
 * @author     Bram Waasdorp <bram@waasdorpsoekhan.nl>
 * @copyright  Copyright (c)  2017, Bram Waasdorp
 * @link       https://github.com/bramwaas/wordpress-plugin-wsaallotment
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
/**
 * Admin list view on allotment
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function wsaallotment_allotments_list() {
	?>
    <link type="text/css" href="<?php echo plugin_dir_url(  __FILE__ ) . 'css/style-admin.css' ?>" rel="stylesheet" />
    <div class="wrap">
         <h2><?php _e('Allotments', 'wsaallotment'); ?></h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=wsaallotment_allotment_create'); ?>" title="<?php _e('Add new allotment', 'wsaallotment'); ?>" ><?php _e('Add new allotment', 'wsaallotment'); ?></a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "allotment";
    	$fields = wsaallotment_allotment_fields ();
    	$labels = wsaallotment_allotment_labels ();
        $select_list = implode(", ", array_keys($fields)) . ', allotment_id ';
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
            <?php foreach ($rows as $row) { 
            	$fields = (array) $row;
            	?>
                <tr>
		<?php foreach ($fields as $field => $value) { 
		 	if ($field !== 'allotment_id'){ 
		 		if ($field === 'allotment_section' || $field === 'allotment_nr'){ ?>
                    	<td class="manage-column ss-list-width"><a 	title="<?php _e('Update allotment', 'wsaallotment'); ?>" href="<?php
     echo admin_url('admin.php?page=wsaallotment_allotment_update&allotment_id=' . $fields['allotment_id']); 
				?>"><?php
				echo $value;/**
				* Admin list view on allotment
				*
				* @since  0.1.0
				* @access public
				* @return void
				*/
	  			?></a></td>
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
/**
 * Admin update view on allotment
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function wsaallotment_allotment_update() {
	if (current_user_can('member_administration'   )) {
		
		global $wpdb;
		//update
		$table_name = $wpdb->prefix . "allotment";
		$fields = wsaallotment_allotment_fields ();
		$labels = wsaallotment_allotment_labels ();
		$select_list = implode(", ", array_keys($fields));
		if (isset($_GET['allotment_id'])) {
			$allotment_id= $_GET['allotment_id'];
			if (isset($_POST['update'])) {
				foreach($_POST as $field => $value) {
					if ($field=='update') {}
					else {$fields[$field] = ($value > ' ') ? $value : null;}
				}
				$wpdb->update(
						$table_name, //table
						$fields, //data
						array('allotment_id' => $allotment_id), //whergarhttp://www.waasdorpsoekhan.nl/denere
						array('%s'), //data format
						array('%s') //where format
						);
				if (! isset($message)) { $message = __('Allotment updated', 'wsaallotment');}
			}
			//delete
			else if (isset($_POST['delete'])) {
				$sql= $wpdb->prepare("DELETE FROM $table_name WHERE allotment_id = %s", $allotment_id);
				$wpdb->query($sql);
				unset($fields);
				if (! isset($message)) { $message = __('Allotment deleted', 'wsaallotment');}
			} else {//selecting row to update
				$sql = $wpdb->prepare("SELECT $select_list FROM $table_name WHERE allotment_id=%s", $allotment_id);
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
         <h2><?php _e('Allotment', 'wsaallotment'); ?></h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div>
                  <a href="<?php echo admin_url('admin.php?page=wsaallotment_allotments_list') ?>">&laquo; <?php _e('Back to the allotments list', 'wsaallotment'); ?></a>
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
                <input type='submit' name="update" value='<?php _e('Save', 'wsaallotment'); ?>' title="<?php _e('Update allotment', 'wsaallotment'); ?>" class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='<?php _e('Delete', 'wsaallotment'); ?>' title="<?php _e('Delete allotment', 'wsaallotment'); ?>" class='button' onclick="return confirm('<?php _e('Delete this allotment?','wsaallotment')?>')">
            </form>
        <?php } ?>

    </div>
    <?php
}
else {echo '<div class="wrap">';
    _e('User is not authorised for this function','wsaallotment');
     echo '</div>';}
}   
/**
 * Admin create view on allotment
 *
 * @since  0.1.0
 * @access public
 * @return void
 */

function wsaallotment_allotment_create() {
	if (current_user_can('member_administration'   )) {
		
		//insert
		global $wpdb;
		$table_name = $wpdb->prefix . "allotment";
		$fields = wsaallotment_allotment_fields ();
		$labels = wsaallotment_allotment_labels ();
		if (isset($_POST['insert'])) {
			foreach($_POST as $field => $value) {
				if ($field=='insert') {}
				else {$fields[$field] = ($value > ' ') ? $value : null;}
			}
			$wpdb->insert(
					$table_name, //table
					$fields //data
					/* array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d') //data format	*/
					);
			if (! isset($message)) { $message= __('Allotment inserted', 'wsaallotment');}
		}
		?>
    <link type="text/css" href="<?php echo plugin_dir_url(  __FILE__ ). '../css/style-admin.css' ?>" rel="stylesheet" />
    <div class="wrap">
        <h2><?php _e('Add new allotment', 'wsaallotment'); ?></h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div>
                  <a href="<?php echo admin_url('admin.php?page=wsaallotment_allotments_list') ?>">&laquo; <?php _e('Back to the allotment list', 'wsaallotment'); ?></a>
        <?php endif; ?>
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
            <input type='submit' name="insert" value='<?php _e('Save', 'wsaallotment'); ?>' title="<?php _e('Save allotment', 'wsaallotment'); ?>" class='button'>
        </form>
    </div>
    <?php
}
else {echo '<div class="wrap">';
_e('User is not authorised for this function','wsaallotment');
echo '</div>';}
} 
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
         <h2><?php _e('Gardeners', 'wsaallotment'); ?></h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=wsaallotment_gardener_create'); ?>" title="<?php _e('Add new gardener', 'wsaallotment'); ?>" ><?php _e('Add new gardener', 'wsaallotment'); ?></a>
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
            <?php foreach ($rows as $row) { 
            	$fields = (array) $row;
            	?>
                <tr>
		<?php foreach ($fields as $field => $value) { 
		 	if ($field !== 'gardener_id'){ 
				if ($field === 'gardener_last_name'){ ?>
                    	<td class="manage-column ss-list-width"><a 	title="<?php _e('Update gardener', 'wsaallotment'); ?>" href="<?php
     echo admin_url('admin.php?page=wsaallotment_gardener_update&gardener_id=' . $fields['gardener_id']); 
				?>"><?php
	  echo $fields['gardener_last_name'];
	  			?></a></td>
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
/**
 * Admin update view on gardener
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
else {echo '<div class="wrap">';
    _e('User is not authorised for this function','wsaallotment');
     echo '</div>';}
}   
/**
 * Admin create view on gardener
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function wsaallotment_gardener_create() {
	if (current_user_can('member_administration'   )) {
		
		//insert
		global $wpdb;
		$table_name = $wpdb->prefix . "gardener";
		$fields = wsaallotment_gardener_fields ();
		$labels = wsaallotment_gardener_labels ();
		if (isset($_POST['insert'])) {
			foreach($_POST as $field => $value) {
				if ($field=='insert') {}
				else {$fields[$field] = ($value > ' ') ? $value : null;}
			}
			$wpdb->insert(
					$table_name, //table
					$fields //data
					/* array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d') //data format	*/
					);
			if (! isset($message)) { $message= __('Gardener inserted', 'wsaallotment');}
		}
		?>
    <link type="text/css" href="<?php echo plugin_dir_url(  __FILE__ ). '../css/style-admin.css' ?>" rel="stylesheet" />
    <div class="wrap">
        <h2><?php _e('Add new gardener', 'wsaallotment'); ?></h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div>
                  <a href="<?php echo admin_url('admin.php?page=wsaallotment_gardeners_list') ?>">&laquo; <?php _e('Back to the gardeners list', 'wsaallotment'); ?></a>
        <?php endif; ?>
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
            <input type='submit' name="insert" value='<?php _e('Save', 'wsaallotment'); ?>' title="<?php _e('Save gardener', 'wsaallotment'); ?>" class='button'>
        </form>
    </div>
    <?php
}
else {echo '<div class="wrap">';
_e('User is not authorised for this function','wsaallotment');
echo '</div>';}
} 
