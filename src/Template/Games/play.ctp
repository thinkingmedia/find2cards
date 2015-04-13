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

<gm-game game="<?= $game_id ?>" player="<?= $user_id ?>" interval="2000"></gm-game>
