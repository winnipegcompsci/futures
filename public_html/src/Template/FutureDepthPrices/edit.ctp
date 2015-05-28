<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $futureDepthPrice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $futureDepthPrice->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Future Depth Prices'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="futureDepthPrices form large-10 medium-9 columns">
    <?= $this->Form->create($futureDepthPrice); ?>
    <fieldset>
        <legend><?= __('Edit Future Depth Price') ?></legend>
        <?php
            echo $this->Form->input('exchange_id', ['options' => $exchanges, 'empty' => true]);
            echo $this->Form->input('timestamp');
            echo $this->Form->input('asks');
            echo $this->Form->input('bids');
            echo $this->Form->input('contract_type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
