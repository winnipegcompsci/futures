<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Future Trade Prices'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="futureTradePrices form large-10 medium-9 columns">
    <?= $this->Form->create($futureTradePrice); ?>
    <fieldset>
        <legend><?= __('Add Future Trade Price') ?></legend>
        <?php
            echo $this->Form->input('exchange_id', ['options' => $exchanges, 'empty' => true]);
            echo $this->Form->input('timestamp');
            echo $this->Form->input('amount');
            echo $this->Form->input('price');
            echo $this->Form->input('tid');
            echo $this->Form->input('type');
            echo $this->Form->input('contract_type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
