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
<html lang="en">
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>

	<?php // $this->Html->css('base.css') ?>
	<?php //$this->Html->css('cake.css') ?>

	<?= $this->Html->css('/bower/normalize.css/normalize.css') ?>
	<?= $this->Html->css('/bower/bootstrap/dist/css/bootstrap.css') ?>
	<?= $this->Html->css('/css/main.css') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?= Cake\Core\Configure::read('Memory.AppName') ?></a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<?= $this->Flash->render() ?>

	<div class="container">
		<?= $this->fetch('content') ?>
	</div>

	<?php
		foreach($scripts as $script)
		{
			echo $this->Html->script($script);
		}
	?>
	<?= $this->fetch('script') ?>
</body>
</html>
