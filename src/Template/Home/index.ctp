<div class="container">
    <div class="col-md-8">

        <div class="panel panel-default">
            <div class="panel-heading">Sign In</div>
            <div class="panel-body" style="max-width: 400px; margin: 0 auto;">
                <p>You have to sign in via one of the below social networks to play.</p>

                <p>This games requires no special permissions, and does not keep, use or share your email address.</p>

                <?php foreach (\Cake\Core\Configure::read('HybridAuth.providers') as $name => $options): ?>
                    <a class="btn btn-block"
                       href="/users/login/<?= $name ?>"
                       style="background-color: <?= $options["color"] ?>; color: #fff">
                        <i class="<?= $options["icon"] ?>"></i> <?= $name ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Frameworks</div>
            <div class="panel-body">
                <p>Find2cards was created using these popular frameworks.</p>
                <ul>
                    <li><a href="http://cakephp.org/">CakePHP v3</a></li>
                    <li><a href="http://getbootstrap.com/">Bootstrap</a></li>
                    <li><a href="https://angularjs.org/">AngularJS</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

