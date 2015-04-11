<div class="row">
    <div class="col-md-6">
        <div class="starter-template">
            <h1><?= __('Instructions') ?></h1>

            <p>Welcome to the memory game.</p>

            <p>Click "play" to join a game with upto 4 players. When all 4 players are ready the game will begin.</p>

            <p>To win the game, be the first to remove all your cards. To remove a cards select two have the same
                image.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="gmSignIn">
            <?= $this->Html->link(__('Play'), ['controller' => 'match_making', 'action' => 'join'],
                                  ['class' => 'btn btn-primary btn-block']) ?>
            <?= $this->Html->link(__('Stats'), ['controller' => 'games', 'action' => 'stats'],
                                  ['class' => 'btn btn-default btn-block']) ?>
        </div>
    </div>
</div>

