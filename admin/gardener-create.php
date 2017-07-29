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
            <input type='submit' name="insert" value='Save' title="<?php _e('Save gardener', 'wsaallotment'); ?>" class='button'>
        </form>
    </div>
    <?php
}
