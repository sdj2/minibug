<div id="create_bug" class="minibug_content">
<h2>New Bug</h2>
<?php echo validation_errors('<div class="error">', '</div>'); ?>
<?php echo form_open('/create'); ?>
<div id="create_bug_title">
	<?php echo form_label("Title: ",'bug_title'); ?>
	<?php echo form_input('bug_title'); ?>
</div>
<div id="create_bug_description">
	<?php echo form_label("Description: ",'bug_description'); ?>
	<br>
	<?php echo form_textarea('bug_description'); ?>
</div>
<div id="create_bug_controls">
	<?php echo form_submit("submit_create_bug","Create Bug"); ?>
</div>
<?php echo form_close(); ?>
</div>
