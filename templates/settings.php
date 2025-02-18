<?php
/**
 * Template for settings form for open directory
 * @package Open Directory
 * @since 1.00
 */

/**
 * Exit if accessed directly
 */
if(!defined("ABSPATH")) exit;

// echo var_dump(get_option("opendirectory_options"));
$opendirectory_options = get_option("opendirectory_options");
$opendirectory_enabled = (isset($opendirectory_options['enable']) && $opendirectory_options['enable'] === 'on') ? 'checked' : '';
$opendirectory_name = $opendirectory_options['name'] ?? '';
$opendirectory_insert_rules = $opendirectory_options['insert_rule'] ?? '';
$opendirectory_privacy = $opendirectory_options['privacy'] ?? '';



?>
<div class="opendirectory-container">
	<h2>Customize Directory</h2>
	<div class="form-container">
		<form method="POST">
			<input type="hidden" name="opendirectory_nonce" value="<?php echo esc_attr(wp_create_nonce("opendirectory__nonce")); ?>">
			<div class="field-container">
				<label for="enable">Enable Directory?</label>
			    <input type="checkbox" name="opendirectory[enable]" id="enable" <?php echo esc_attr($opendirectory_enabled); ?> />
			</div>
			<div class="field-container">
				<label for="name">Directory For?</label>
			    <input type="text" name="opendirectory[name]" placeholder="eg: Project Ideas/SaaS Ideas" id="name" value="<?php echo esc_attr($opendirectory_name); ?>"  max="15" min="2"/>
			</div>
			<div class="field-container">
				<label for="insert-rule">Insert Rule</label>
			    <select name="opendirectory[insert_rule]" id="insert-rule" title="Who Can Add Directory Item?">
			    	<option value="unknown" <?php echo esc_attr(opendirectory_compare_select($opendirectory_insert_rules, 'unknown')); ?>>Everyone (Even Without Their Name)</option>
			    	<option value="non-user" <?php echo esc_attr(opendirectory_compare_select($opendirectory_insert_rules, 'non-user')); ?>>Registered and Non Registered</option>
			    	<option value="user" <?php echo esc_attr(opendirectory_compare_select($opendirectory_insert_rules, 'user')); ?>>Only Users</option>
			    	<option value="admin" <?php echo esc_attr(opendirectory_compare_select($opendirectory_insert_rules, 'admin')); ?>>Only Admin</option>
			    	<option value="nobody" <?php echo esc_attr(opendirectory_compare_select($opendirectory_insert_rules, 'nobody')); ?>>Nobody</option>
			    </select>
			</div>
			<div class="field-container">
				<label for="privacy">Directory Privacy</label>
			    <select name="opendirectory[privacy]" id="privacy" title="Who Can Vist The Directory?">
			    	<option value="everyone" <?php echo esc_attr(opendirectory_compare_select($opendirectory_privacy, 'everyone')); ?>>Everyone</option>
			    	<option value="user" <?php echo esc_attr(opendirectory_compare_select($opendirectory_privacy, 'user')); ?>>Only Users</option>
			    	<option value="admin" <?php echo esc_attr(opendirectory_compare_select($opendirectory_privacy, 'admin')); ?>>Only Admin</option>
			    	<option value="private" <?php echo esc_attr(opendirectory_compare_select($opendirectory_privacy, 'private')); ?>>Private</option>
			    </select>
			</div>
			<div class="submit-container">
				<button name="opendirectory_submit">Update</button>
			</div>
		</form>
	</div>
</div>