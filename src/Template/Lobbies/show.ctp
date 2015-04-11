<?php
/**
 * @var \App\Model\Entity\Game $game
 */
?>

<gm-lobby game="<?=$game->id?>" interval="1000"></gm-lobby>

<!--
<div class="alert alert-info" role="alert">Connecting with other players...</div>
-->

<gm-timer value="60"></gm-timer>

<?= $this->Html->link(__('Ready'), ['controller' => 'lobbies', 'action' => 'ready', $game->id],
                      ['class' => 'btn btn-primary btn-block']) ?>

<?= $this->Html->link(__('Leave'), ['controller' => 'lobbies', 'action' => 'leave', $game->id],
                      ['class' => 'btn btn-default btn-block']) ?>
