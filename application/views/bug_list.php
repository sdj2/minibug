<?php

function bug_list_th($sorting) {
	$th = array();
	$base = array();
	$base['id'] = 'ID';
	$base['name'] = 'Title';
	$base['created'] = 'Created On';
	$base['status'] = 'Status';
	foreach ( $base as $index => $label ) {
		$link = array();
		$link['label'] = $label;
		if ($index == $sorting['order']) {
			if($sorting['desc']) {
				$link['href'] = site_url("get_all/$index/0/up");
			} else {
				$link['href'] = site_url("get_all/$index/0/down");
			}
		} else {
			$link['href'] = site_url("get_all/$index/0/up");
		}
		$th[] = $link;
	}
	return $th;
}
?>
<div id="bug_list" class="minibug_content">
	<h2>Bug List</h2>
	<?php if ($pagination): ?>
		<div class='pagination'><?php echo $pagination; ?></div>
	<?php endif; ?>
	<?php if ($bug_list): ?>
		<table id="bug_list_table">
			<tr>
				<?php foreach(bug_list_th($sorting) as $th): ?>
					<th><a href="<?php echo $th['href'];?>"><?php echo $th['label'];?></a></th>
				<?php endforeach; ?>
			</tr>
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
		<?php if ($pagination): ?>
			<div class='pagination'><?php echo $pagination; ?></div>
		<?php endif; ?>
	<?php else: ?>
		</table>
		<div class="notice">No bugs found.</div>
	<?php endif; ?>
	<a href="<?php echo site_url('create');?>">Add New Bug</a>
</div>
