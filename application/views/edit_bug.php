<?php
// build status dropdown key->val map from set of options
function status_dropdown($r_in) {
	$r_out = array();
	foreach($r_in as $v) {
		$r_out[$v] =  $v;
	}
	return $r_out;
}
?>

<div id="edit_bug" class="minibug_content">
<h2>Edit Bug</h2>
<?php echo validation_errors('<div class="error">', '</div>'); ?>
<?php echo form_open(''); ?>
<div id="edit_bug_title">
	<?php echo form_label("Title: ",'bug_title'); ?>
	<br>
	<?php echo form_input(array('name'=>'bug_title','value'=>$bug->name,'size'=>64)); ?>
</div>
<div id="edit_bug_status">
	<?php echo form_label("Status: ",'bug_status'); ?>
	<?php echo form_dropdown('bug_status',status_dropdown($bug_status_list),$bug->status); ?>
</div>
<div id="edit_bug_description">
	<?php echo form_label("Description: ",'bug_description'); ?>
	<br>
	<textarea name="bug_description" rows="10" cols="40"><?php echo htmlentities($bug->description);?></textarea>
</div>
<div id="edit_bug_controls">
	<?php echo form_submit("submit_update_bug","Update Bug"); ?>
</div>
<?php echo form_close(); ?>
</div>
