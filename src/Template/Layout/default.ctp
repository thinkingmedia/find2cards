<?php
$scripts = [
	'/bower/angular/angular.js',
	'/bower/angular-bootstrap/ui-bootstrap.js',
	'/bower/angular-bootstrap/ui-bootstrap-tpls.js',
	'/bower/jquery/dist/jquery.js',
	'/bower/lodash/lodash.js'
];
?>
<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>

	<?= $this->Html->css('base.css') ?>
	<?= $this->Html->css('/bower/bootstrap/dist/css/bootstrap.css') ?>
	<?php //$this->Html->css('cake.css') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
</head>
<body>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
<?php
	foreach($scripts as $script)
	{
		echo $this->Html->script($script);
	}
?>
<?= $this->fetch('script') ?>
</body>
</html>
