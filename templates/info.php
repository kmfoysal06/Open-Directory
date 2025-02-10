<?php
/**
 * Template for open directory settings informations
 * @package Open Directory
 * @since 1.00
 */

/**
 * Exit if accessed directly
 */
if(!defined("ABSPATH")) exit;

$opendirectory_options = get_option("opendirectory_options");
$opendirectory_enabled = ($opendirectory_options['enable'] && $opendirectory_options['enable'] === 'on') ? 'Yes' : 'No';
$opendirectory_name = $opendirectory_options['name'] ?? '';
$opendirectory_insert_rules = $opendirectory_options['insert_rule'] ?? 'Everyone';
$opendirectory_privacy = $opendirectory_options['privacy'] ?? 'Everyone';
$opendirectory_slug = !empty($opendirectory_name) ? sanitize_title('odir_' . $opendirectory_name) : 'odir';
$opendirectory_total_items = wp_count_posts($opendirectory_slug)->publish ?? 0;
?>
<div class="container">
	<h2>Open Directory</h2>
	<div class="informations">
		<p><b>Enabled</b>: <?php echo esc_html($opendirectory_enabled); ?></p>
		<p><b>Directory For</b>: <?php echo esc_html($opendirectory_name); ?></p>
		<p><b>Total Items</b>: <?php echo esc_html($opendirectory_total_items); ?></p>
		<p><b>Insert Rule</b>: <?php echo esc_html(ucfirst($opendirectory_insert_rules)); ?></p>
		<p><b>Directory Privacy</b>: <?php echo esc_html(ucfirst($opendirectory_privacy)); ?></p>
	</div>
</div>