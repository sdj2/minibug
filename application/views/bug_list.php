<div id="bug_list">
	<div id="bug_list_label">Bug List</div>
	<table id="bug_list_table" border="0" cellspacing="12">
	<tr>
		<th><a href="<?php echo site_url('get_all/id');?>">ID</a></th>
		<th><a href="<?php echo site_url('get_all/name');?>">Title</a></th>
		<th><a href="<?php echo site_url('get_all/created');?>">Created On</a></th>
		<th><a href="<?php echo site_url('get_all/status');?>">Status</a></th>
	</tr>
	<?php if ($errors): ?>
	<?php foreach($errors as $msg): ?>
		<div class="error"><?php echo $msg;?></div>
	<?php endforeach; ?>
	<?php elseif ($bug_list): ?>
		<?php foreach ($bug_list as $bug):?>
			<tr>
				<td><?php echo htmlentities($bug->id); ?>
				<td><?php echo htmlentities($bug->name); ?>
				<td><?php echo htmlentities($bug->created); ?>
				<td><?php echo htmlentities($bug->status); ?>
				<td><a href="<?php echo site_url('view/'.urlencode($bug->id));?>">view</a></td>
				<td><a href="<?php echo site_url('edit/'.urlencode($bug->id));?>">edit</a></td>
			</tr>
		<?php endforeach;?>
		</table>
	<?php else: ?>
		</table>
		<div class="notice">No bugs found.</div>
	<?php endif; ?>

</div>
