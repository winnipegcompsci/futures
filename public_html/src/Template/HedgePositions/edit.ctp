<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $hedgePosition->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hedgePosition->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Hedge Positions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="hedgePositions form large-10 medium-9 columns">
    <?= $this->Form->create($hedgePosition); ?>
    <fieldset>
        <legend><?= __('Edit Hedge Position') ?></legend>
        <?php
            echo $this->Form->input('exchange_id', ['options' => $exchanges, 'empty' => true]);
            echo $this->Form->input('bias');
            echo $this->Form->input('amount');
            echo $this->Form->input('ssp');
            echo $this->Form->input('leverage');
            echo $this->Form->input('balance');
            echo $this->Form->input('lastprice');
            echo $this->Form->input('timeopened');
            echo $this->Form->input('recalculation');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
