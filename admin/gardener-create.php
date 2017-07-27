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
	$fields = array(
			'user_login' => null,
			'gardener_email' => null,
			'gardener_initials' => null,
			'gardener_infix' => null,
			'gardener_last_name' => null,
			'gardener_first_name' => null,
			'allotment_section' => null,
			'allotment_nr' => null); //data
	$labels = array('gardener_id' => __('Id' , 'wsaallotment'),
			'user_login' => __('Login' , 'wsaallotment'),
			'gardener_email' => __('Email' , 'wsaallotment'),
			'gardener_initials' => __('Initials' , 'wsaallotment'),
			'gardener_infix' => __('Infix' , 'wsaallotment'),
			'gardener_last_name' => __('Last name' , 'wsaallotment'),
			'gardener_first_name' => __('First name' , 'wsaallotment'),
			'allotment_section' => __('Section' , 'wsaallotment'),
			'allotment_nr' => __('Nr' , 'wsaallotment')); 
	
	
	if (isset($_POST['insert'])) {
		foreach($_POST as $field => $value) {
			if ($field=='insert') {}
			else {$fields[$field] = ($value > ' ') ? $value : null;}
		}
        $wpdb->insert(
                $table_name, //table
        		$fields, //data
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
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}
