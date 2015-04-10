<?php
//$this->Form->submit('Login');
?>

<?= $this->Flash->render('auth'); ?>

<div ng-controller="gmSignInController as signIn">
    <form novalidate method="post" accept-charset="utf-8" action="/" ng-submit="signIn.Submit()">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="provider" ng-model="model.provider">
        <input type="hidden" name="openid_identifier" value="http://memory.thinkingmedia.local/">
        <?php foreach (\Cake\Core\Configure::read('HybridAuth.providers') as $name => $options): ?>
            <button class='btn'
                    style='background-color: <?= $options["color"] ?>; color: #fff'
                    ng-click="$event.preventDefault(); model.provider = '<?= $name ?>'">
                <i class='<?= $options["icon"] ?>'></i> <?= $name ?>
            </button>
        <?php endforeach; ?>
    </form>
</div>
