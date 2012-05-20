<div id="bug_list">
	<div id="bug_list_label">Bug List</div>
	<table id="bug_list" border="0" cellspacing="12">
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Created On</th>
		<th>Status</th>
	</tr>
	<?php if ($bug_list): ?>
		<?php foreach ($bug_list as $bug):?>
			<tr>
				<td><?php echo $bug->id; ?>
				<td><?php echo htmlentities($bug->name); ?>
				<td><?php echo $bug->created; ?>
				<td><?php echo $bug->status; ?>
				<td><a href="">view</a></td>
				<td><a href="">edit</a></td>
			</tr>
		<?php endforeach;?>
		</table>
	<?php else: ?>
		</table>
		<div class="notice">No bugs found.</div>
	<?php endif; ?>

</div>
