<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" ng-init="navCollapsed = true" ng-click="navCollapsed = !navCollapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><?= Cake\Core\Configure::read('find2cards.AppName') ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse" ng-class="{'in':!navCollapsed}" ng-click="navCollapsed=true">
            <ul class="nav navbar-nav">
                <?php foreach($menu as $item): ?>
                <li><?=$this->Html->link($item['title'],$item['url'],$item['options'])?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
