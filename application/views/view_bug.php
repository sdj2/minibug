<div id="view_bug">
<div id="view_bug_label">View Bug</div>
	<dl id="bug_details">
		<dt>ID</dt>
		<dd><?php echo htmlentities($bug->id); ?></dd>
		<dt>Title</dt>
		<dd><?php echo htmlentities($bug->name); ?></dd>
		<dt>Status</dt>
		<dd><?php echo htmlentities($bug->status); ?></dd>
		<dt>Created On </dt>
		<dd><?php echo htmlentities($bug->created); ?></dd>
		<dt>Description</dt>
		<dd><?php echo htmlentities($bug->description); ?></dd>
	</dl>
	<div id="bug_hist">
	<div id="bug_hist_label">Bug Status History</div>
	<?php if ($bug->history): ?>
		<table id="bug_hist_table" cellspacing="12">
		<tr>
			<th>ID</th>
			<th>Status</th>
			<th>Updated On</th>
		</tr>
		<?php foreach ($bug->history as $bug_change):?>
			<tr>
			<td><?php echo htmlentities($bug_change->bug_id);?></td>
			<td><?php echo htmlentities($bug_change->new_status);?></td>
			<td><?php echo htmlentities($bug_change->changed);?></td>
			</tr>
		<?php endforeach;?>
		</table>
	<?php else: ?>
		<div class="notice">Bug history not found.</div>
	<?php endif; ?>
	</div>
</div>
