<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $futureTickerPrice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $futureTickerPrice->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Future Ticker Prices'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="futureTickerPrices form large-10 medium-9 columns">
    <?= $this->Form->create($futureTickerPrice); ?>
    <fieldset>
        <legend><?= __('Edit Future Ticker Price') ?></legend>
        <?php
            echo $this->Form->input('exchange_id', ['options' => $exchanges, 'empty' => true]);
            echo $this->Form->input('timestamp');
            echo $this->Form->input('last');
            echo $this->Form->input('buy');
            echo $this->Form->input('sell');
            echo $this->Form->input('high');
            echo $this->Form->input('low');
            echo $this->Form->input('volume');
            echo $this->Form->input('contract');
            echo $this->Form->input('contract_type');
            echo $this->Form->input('unit_amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
