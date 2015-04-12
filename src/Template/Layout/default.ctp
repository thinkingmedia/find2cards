<?php
$scripts = [
    '/bower/angular/angular.js',
    '/bower/angular-bootstrap/ui-bootstrap.js',
    '/bower/angular-bootstrap/ui-bootstrap-tpls.js',
    '/bower/jquery/dist/jquery.js',
    '/bower/lodash/lodash.js',
    '/bower/moment/moment.js',
    '/bower/closure-library/closure/goog/base.js',
    '/js/deps.js',
    '/src/gmMem/_Package.js',
    '/src/gmMem/_All.js'
];
?>
<!DOCTYPE html>
<html lang="en" ng-app="gmMem">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('/bower/normalize.css/normalize.css') ?>
    <?= $this->Html->css('/bower/bootstrap/dist/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/bower/fontawesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('/css/styles.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>

<?= isset($user) ? $this->cell('Menu::user', ['user' => $user]) : $this->cell('Menu::visitor') ?>

<div class="container">
    <?= $this->Flash->render() ?>
    <?= $this->Flash->render('auth'); ?>
    <?= $this->fetch('content') ?>
</div>

<?php
foreach ($scripts as $script)
{
    echo $this->Html->script($script, ['type' => 'text/javascript']);
}
?>
<?= $this->fetch('script') ?>
</body>
</html>
