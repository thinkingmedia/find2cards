<div class="row">
	<div class="col-md-6">
		<div class="starter-template">
			<h1><?= __('The Memory Game') ?></h1>
			<p class="lead">Welcome to the memory game. Click "play" to join a game with other players.</p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="gmSignIn">
            <?= $this->Html->link(__('Play'),['controller'=>'games','action'=>'join'],['class'=>'btn btn-primary btn-block']) ?>
            <?= $this->Html->link(__('Stats'),['controller'=>'games','action'=>'stats'],['class'=>'btn btn-default btn-block']) ?>
		</div>
	</div>
</div>

