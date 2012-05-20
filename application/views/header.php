<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />
<head>
        <title>MiniBug <?php echo isset($title) ? ' - '.$title : '';?></title>
</head>
<body>
<div id="banner">
	<a href="<?php echo site_url(""); ?>">MiniBug</a>
</div>
<?php if (isset($errors) && count($errors) > 0): ?>
	<?php foreach($errors as $msg): ?>
		<div class="error"><?php echo $msg;?></div>
	<?php endforeach; ?>
<?php endif; ?>
<?php if (isset($notices) && count($notices) > 0): ?>
	<?php foreach($notices as $msg): ?>
		<div class="notice"><?php echo $msg;?></div>
	<?php endforeach; ?>
<?php endif; ?>
