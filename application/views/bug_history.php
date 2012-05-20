<div id="bug_history">
	<?php if ($bug_history): ?>
		<?php foreach ($bug_history as $bug_change):?>
		<div class="bug">
			<?php echo $bug_change->bug_id . ' | ' . $bug_change->new_status . ' | ' . $bug_change->changed;?>
		</div>
		<?php endforeach;?>
	<?php else: ?>
		<div class="notice">Bug history not found.</div>
	<?php endif; ?>

</div>
