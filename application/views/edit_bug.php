<div id="edit_bug">
<div id="edit_bug_label"><strong>Edit Bug</strong></div>
<?php echo form_open('edit'); ?>
<div id="edit_bug_title">
	<?php echo form_label("Title: ",'bug_title'); ?>
	<?php echo form_input('bug_title'); ?>
</div>
<div id="edit_bug_status">
	<?php echo form_label("Status: ",'bug_status'); ?>
	<?php echo form_dropdown('bug_status',$bug_status_list,$bug_current_status); ?>
</div>
<div id="edit_bug_description">
	<?php echo form_label("Description: ",'bug_description'); ?>
	<br>
	<?php echo form_textarea('bug_description'); ?>
</div>
<div id="edit_bug_controls">
	<?php echo form_submit("submit_update_bug","Update Bug"); ?>
</div>
<?php echo form_close(); ?>
</div>
