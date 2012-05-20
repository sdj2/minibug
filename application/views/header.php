<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />
<head>
        <title>MiniBug <?php echo isset($title) ? ' - '.$title : '';?></title>
	<link rel="StyleSheet" href="<?php echo base_url("css/minibug.css"); ?>" type="text/css" media="screen" />
</head>
<body>
<div id="banner">
	<h1><a href="<?php echo site_url(""); ?>">MiniBug</a></h1>
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
