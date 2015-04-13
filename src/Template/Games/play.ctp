<?php
/**
 * @var int   $game_id
 * @var int   $user_id
 * @var array $cards
 */

$json = json_encode($cards);
$this->Html->scriptStart(['block' => true, 'safe' => false]);
?>
(function(){
var cards = <?= $json ?>;

gmMem.Angular.constant('cards',cards);
})();
<?php $this->Html->scriptEnd(); ?>

<div class="gmGame">

    <div class="gmGame-Players panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Players</h3>
        </div>
        <div class="panel-body">
            <gm-player image="<?= $user['image'] ?>" value="43"></gm-player>
        </div>
    </div>

    <div class="gmGame-Board panel panel-default">
        <gm-game game="<?= $game_id ?>" player="<?= $user_id ?>" interval="2000"></gm-game>
    </div>

</div>
