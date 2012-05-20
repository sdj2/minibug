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

<div id="edit_bug">
<div id="edit_bug_label"><strong>Edit Bug</strong></div>
<?php echo validation_errors('<div class="error">', '</div>'); ?>
<?php if($errors):?>
	<?php foreach($errors as $msg): ?>
		<div class="error"><?php echo $msg;?></div>
	<?php endforeach; ?>
<?php endif; ?>
<?php echo form_open(''); ?>
<div id="edit_bug_title">
	<?php echo form_label("Title: ",'bug_title'); ?>
	<?php echo form_input('bug_title',$bug->name); ?>
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
