<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $game->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $game->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Games'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="games form large-10 medium-9 columns">
    <?= $this->Form->create($game); ?>
    <fieldset>
        <legend><?= __('Edit Game') ?></legend>
        <?php
            echo $this->Form->input('match_making');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
