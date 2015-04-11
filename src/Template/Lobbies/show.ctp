<?php
/**
 * @var \App\Model\Entity\Game $game
 */
?>

<gm-player-loader></gm-player-loader>
<gm-player-loader></gm-player-loader>
<gm-player-loader></gm-player-loader>
<gm-player-loader></gm-player-loader>

<!--
<div class="alert alert-info" role="alert">Connecting with other players...</div>
-->

<?= $this->Html->link(__('Ready'), ['controller' => 'lobbies', 'action' => 'ready', $game->id],
                      ['class' => 'btn btn-primary btn-block']) ?>

<?= $this->Html->link(__('Leave'), ['controller' => 'lobbies', 'action' => 'leave', $game->id],
                      ['class' => 'btn btn-default btn-block']) ?>
