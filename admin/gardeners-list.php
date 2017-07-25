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
        $rows = $wpdb->get_results("SELECT user_login,gardener_email,gardener_initials,gardener_infix,gardener_last_name,gardener_first_name,allotment_section,allotment_nr,gardener_id from $table_name");
         ?>
        <table class='table table-striped wp-list-table widefat fixed striped posts'>
            <thead>
            <tr>
                <th class="manage-column ss-list-width">Login</th>
                <th class="manage-column ss-list-width">Email</th>
                <th class="manage-column ss-list-width">Initials</th>
                <th class="manage-column ss-list-width">Infix</th>
                <th class="manage-column ss-list-width">Last name</th>
                <th class="manage-column ss-list-width">First name</th>
                <th class="manage-column ss-list-width">Section</th>
                <th class="manage-column ss-list-width">Nr</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->user_login; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->gardener_email; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->gardener_initials; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->gardener_infix; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->gardener_last_name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->gardener_first_name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->allotment_section; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->allotment_nr; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=wsaallotment_gardener_update&gardener_id=' . $row->gardener_id); ?>">Update</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
}
