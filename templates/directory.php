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
$opendirectory_posts = new \WP_Query([
	'post_type' => $opendirectory_slug,
	'posts_per_page' => '-1',
	'post_status' => 'publish'
]);


?>
<div class="opendirectory-list-container">
	<?php if($opendirectory_privacy === "private"): ?>
    	<div class="container">
	        <h2>You Are Not Allowed to This Page</h2>
	    </div>
	<?php return;endif; ?>

	<?php if($opendirectory_privacy === "admin" && !current_user_can('administrator')): ?>
    	<div class="container">
	        <h2>You Are Not Allowed to This Page</h2>
	    </div>
	<?php return;endif; ?>

	<?php if($opendirectory_privacy === "user" && !is_user_logged_in()): ?>
    	<div class="container">
	        <h2>You Are Not Allowed to This Page</h2>
	    </div>
	<?php return;endif; ?>

	<h1><?php echo esc_html($opendirectory_name); ?></h1>
    <?php
	    if($opendirectory_posts->have_posts()):
			while($opendirectory_posts->have_posts()):
				$opendirectory_posts->the_post();
				$user_name = get_the_author_meta("user_login");
	?>
			    <div class="item">
			        <div class="username">@<?php echo esc_html($user_name); ?></div>
			        <p class="text"><?php echo esc_html(get_the_title()); ?></p>
			    </div>

    <?php
			endwhile;
		endif;
		wp_reset_postdata();
     ?>
</div>