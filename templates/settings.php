<?php
/**
 * Template for settings form for open directory
 * @package Open Directory
 * @since 1.00
 */
?>
<div class="container">
	<h2>Customize Directory</h2>
	<div class="form-container">
		<form>
			<div class="field-container">
				<label for="enable">Enable Directory?</label>
			    <input type="checkbox" name="opendirectory[enable]" id="enable" />
			</div>
			<div class="field-container">
				<label for="name">Directory For?</label>
			    <input type="text" name="opendirectory[name]" placeholder="eg: Project Ideas/SaaS Ideas" id="name" />
			</div>
		</form>
	</div>
</div>