<div id="bug_list">
	<?php if ($bug_list): ?>
		<?php foreach ($bug_list as $bug):?>
		<div class="bug">
			<?php echo $bug->id . ' | ' . $bug->name . ' | ' . $bug->created . ' | ' . $bug->status;?>
		</div>
		<?php endforeach;?>
	<?php else: ?>
		<div class="notice">No bugs found.</div>
	<?php endif; ?>

</div>
