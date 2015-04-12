<?php
/**
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="col-md-4">
        <gm-player image="<?= $user['image'] ?>" value="0" user="<?= $user['id'] ?>"></gm-player>
        <h3><?= $user['name'] ?></h3>

        <h1><?= __('Instructions') ?></h1>

        <p>Welcome to the memory game.</p>

        <p>Click "play" to join a game with upto 4 players. When all 4 players are ready the game will begin.</p>

        <p>To win the game, be the first to remove all your cards. To remove a cards select two have the same
            image.</p>
    </div>
    <div class="col-md-4">
        <?= $this->Html->link(__('Join A New Game'), ['controller' => 'lobbies', 'action' => 'join'],
                              ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <div class="col-md-4">

        <h1>Finished Games Here</h1>
    </div>
</div>

