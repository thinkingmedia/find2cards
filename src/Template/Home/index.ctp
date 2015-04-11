<h1>Start</h1>
<p>You have to sign in via one of the below social networks to play.</p>

<?php foreach (\Cake\Core\Configure::read('HybridAuth.providers') as $name => $options): ?>
    <a class="btn"
       href="/users/login/<?= $name ?>"
       style="background-color: <?= $options["color"] ?>; color: #fff">
        <i class="<?= $options["icon"] ?>"></i> <?= $name ?>
    </a>
<?php endforeach; ?>
