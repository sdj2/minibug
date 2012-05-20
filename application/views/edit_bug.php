<?php
// build dropdown key->val map from set of options
function quick_dropdown($r_in) {
	$r_out = array();
	foreach($r_in as $v) {
		$r_out[$v] =  $v;
	}
	return $r_out;
}
?>

<div id="edit_bug">
<div id="edit_bug_label"><strong>Edit Bug</strong></div>
<?php echo form_open(''); ?>
<div id="edit_bug_title">
	<?php echo form_label("Title: ",'bug_title'); ?>
	<?php echo form_input('bug_title',htmlentities($bug->name)); ?>
</div>
<div id="edit_bug_status">
	<?php echo form_label("Status: ",'bug_status'); ?>
	<?php echo form_dropdown('bug_status',quick_dropdown($bug_status_list),$bug->status); ?>
</div>
<div id="edit_bug_description">
	<?php echo form_label("Description: ",'bug_description'); ?>
	<br>
	<?php echo form_textarea('bug_description',htmlentities($bug->description)); ?>
</div>
<div id="edit_bug_controls">
	<?php echo form_submit("submit_update_bug","Update Bug"); ?>
</div>
<?php echo form_close(); ?>
</div>
