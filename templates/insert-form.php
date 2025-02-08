<?php
/**
 * Template for Directory Listing Shortcode
 * @package Open Directory
 * @since 1.00
 */

$opendirectory_options = get_option("opendirectory_options");
$opendirectory_enabled = ($opendirectory_options['enable'] && $opendirectory_options['enable'] === 'on') ? true : false;
$opendirectory_name = $opendirectory_options['name'] ?? '';
$opendirectory_insert_rules = $opendirectory_options['insert_rule'] ?? 'Everyone';
$opendirectory_privacy = $opendirectory_options['privacy'] ?? 'Everyone';
$opendirectory_slug = !empty($opendirectory_name) ? sanitize_title('odir_' . $opendirectory_name) : 'odir';
$opendirectory_total_items = wp_count_posts($opendirectory_slug)->publish ?? 0;



?>
<style>
    /*body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f4;
    }*/

    .post-title, .post-meta {
        display: none;
    }

    .opendir-insert-container {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 1000px;
        margin-inline: auto;
        margin-block: 10px;
        text-align: center;
    }

/* Form Title */
.opendir-insert-container h2 {
    margin-bottom: 15px;
    color: #333;
}

/* Labels */
.opendir-insert-container label {
    display: block;
    text-align: left;
    font-weight: bold;
    margin: 10px 0 5px;
}

/* Textarea Styling */
.opendir-insert-container textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: none;
}
/* Input Styling */
.opendir-insert-container input[type=text] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Submit Button */
.opendir-insert-container button {
    display: block;
    margin-top: 15px;
    margin-inline-start: auto;
    width: 100%;
    max-width: 200px;
    padding: 12px;
    border: none;
    background: #5a67d8;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.opendir-insert-container button:hover {
    background: #434190;
}


</style>
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

        <form action="#" method="post">
            <h2>Add New Data to <?php echo esc_html($opendirectory_name) ?></h2>
            <?php if(!is_user_logged_in()): ?>
                <label for="uname">Insert Your Name*</label>
                <input type="text" name="username" placeholder="alex..">
            <?php endif; ?>
            <label for="post">Your Post:</label>
            <textarea id="post" name="post" rows="6" placeholder="Write something..." required></textarea>

            <button type="submit">Submit</button>
        </form>
    <?php endif; ?>
</div>