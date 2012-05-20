<div id="view_bug" class="minibug_content">
	<h2>View Bug</h2>
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
		<dt>Bug Status History</dt>
		<dd>
			<?php if ($bug->history): ?>
				<table id="bug_hist_table" cellspacing="12">
				<tr>
					<th>Status</th>
					<th>Updated On</th>
				</tr>
				<?php foreach ($bug->history as $bug_change):?>
					<tr>
					<td><?php echo htmlentities($bug_change->new_status);?></td>
					<td><?php echo htmlentities($bug_change->changed);?></td>
					</tr>
				<?php endforeach;?>
				</table>
			<?php else: ?>
				<div class="notice">Bug history not found.</div>
			<?php endif; ?>
		</dd>
	</dl>
	<a href="<?php echo site_url('edit/'.urlencode($bug->id));?>">Edit Bug</a></td>
</div>
