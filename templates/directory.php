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
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f8f9fa;
        color: #333;
    }

    .container {
        max-width: 800px;
        margin: auto;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    h1 {
        text-align: center;
        color: #007bff;
    }

    .item {
        margin-bottom: 20px;
        padding: 15px;
        border-left: 4px solid #007bff;
        background: #f1f1f1;
        border-radius: 4px;
    }

    .username {
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
    }

    .text {
        font-size: 14px;
        line-height: 1.6;
    }
</style>
<div class="container">
    <h1>Listing Page</h1>
    <?php
	    if($opendirectory_posts->have_posts()):
			while($opendirectory_posts->have_posts()):
				$opendirectory_posts->the_post();
	?>
			    <div class="item">
			        <div class="username">@kmfoysal06</div>
			        <p class="text"><?php echo get_the_title(); ?></p>
			    </div>

    <?php
			endwhile;
		endif;
		wp_reset_query();
     ?>

</div>