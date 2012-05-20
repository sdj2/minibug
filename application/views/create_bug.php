<div id="create_bug" class="minibug_content">
<h2>New Bug</h2>
<?php echo validation_errors('<div class="error">', '</div>'); ?>
<?php echo form_open('/create'); ?>
<div id="create_bug_title">
	<?php echo form_label("Title: ",'bug_title'); ?>
	<br>
	<?php echo form_input(array('name'=>'bug_title','size'=>64)); ?>
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
