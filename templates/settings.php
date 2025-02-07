<?php
/**
 * Template for settings form for open directory
 * @package Open Directory
 * @since 1.00
 */

echo var_dump(get_option("opendirectory_options"));
?>
<style>



</style>
<div class="opendirectory-container">
	<h2>Customize Directory</h2>
	<div class="form-container">
		<form method="POST">
			<input type="hidden" name="opendirectory_nonce" value="<?php echo esc_attr(wp_create_nonce("opendirectory__nonce")); ?>">
			<div class="field-container">
				<label for="enable">Enable Directory?</label>
			    <input type="checkbox" name="opendirectory[enable]" id="enable" />
			</div>
			<div class="field-container">
				<label for="name">Directory For?</label>
			    <input type="text" name="opendirectory[name]" placeholder="eg: Project Ideas/SaaS Ideas" id="name" />
			</div>
			<div class="field-container">
				<label for="insert-rule">Insert Rule</label>
			    <select name="opendirectory[insert_rule]" id="insert-rule" title="Who Can Add Directory Item?">
			    	<option value="unknown">Everyone (Even Without Their Name)</option>
			    	<option value="non-user">Registered and Non Registered</option>
			    	<option value="user">Only Users</option>
			    	<option value="admin">Only Admin</option>
			    	<option value="private">Nobody</option>
			    </select>
			</div>
			<div class="field-container">
				<label for="privacy">Directory Privacy</label>
			    <select name="opendirectory[privacy]" id="privacy" title="Who Can Vist The Directory?">
			    	<option value="everyone">Everyone</option>
			    	<option value="user">Only Users</option>
			    	<option value="admin">Only Admin</option>
			    	<option value="private">Private</option>
			    </select>
			</div>
			<div class="submit-container">
				<button name="opendirectory_submit">Update</button>
			</div>
		</form>
	</div>
</div>