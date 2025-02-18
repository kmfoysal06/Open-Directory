<?php
/**
 * Template for Directory Listing Shortcode
 * @package Open Directory
 * @since 1.00
 */

/**
 * Exit if accessed directly
 */
if(!defined("ABSPATH")) {
    exit;
}

$opendirectory_options = get_option("opendirectory_options");
$opendirectory_enabled = false;
/**
 * Check if the directory enabled
 */
if(isset($opendirectory_options['enable'])) {
    if($opendirectory_options['enable'] === 'on') {
        $opendirectory_enabled = true;
    }
}
$opendirectory_name = $opendirectory_options['name'] ?? '';
$opendirectory_insert_rules = $opendirectory_options['insert_rule'] ?? 'Everyone';
$opendirectory_privacy = $opendirectory_options['privacy'] ?? 'Everyone';
$opendirectory_list_page = get_permalink(get_page_by_path('opendirectory_list'));


?>
<div class="opendir-insert-container">
    <?php if($opendirectory_insert_rules === 'nobody'): ?>
        <div class="container">
            <h2>You Are Not Allowed to This Page</h2>
        </div>
    <?php else: ?>
        <?php if($opendirectory_insert_rules === 'admin' && !current_user_can('administrator')): ?>
            <div class="container">
                <h2>You Are Not Allowed to This Page</h2>
            </div>
        <?php return;endif; ?>
        <?php if($opendirectory_insert_rules === 'user' && !is_user_logged_in()): ?>
            <div class="container">
                <h2>You Are Not Allowed to This Page</h2>
            </div>
        <?php return;endif; ?>

        <form method="post">
            <h2>Add New Data to <?php echo esc_html($opendirectory_name) ?></h2>
            <?php if(!is_user_logged_in()): ?>
                <div class="odir-username-container">
                    <label for="uname">Insert Your Name<?php echo $opendirectory_insert_rules !== 'unknown' ? "*" : "" ?></label>
                    <input type="text" id="uname" name="username" class="odir_uname" placeholder="alex.." <?php echo $opendirectory_insert_rules !== 'unknown' ? "required" : "" ?> autocomplete="false" />
                </div>
            <?php endif; ?>
            <label for="post">Your Post:</label>
            <textarea id="post" class="odir_post" name="post" rows="6" placeholder="Write something..." required></textarea>

            <button type="button" class="odir_submit">Submit</button>
        </form>
    <?php endif; ?>
</div>
<a href="<?php echo esc_url($opendirectory_list_page) ?>"><?php echo esc_html("All " . $opendirectory_name); ?></a>
