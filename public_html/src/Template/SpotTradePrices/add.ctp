<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Spot Trade Prices'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="spotTradePrices form large-10 medium-9 columns">
    <?= $this->Form->create($spotTradePrice); ?>
    <fieldset>
        <legend><?= __('Add Spot Trade Price') ?></legend>
        <?php
            echo $this->Form->input('exchange_id', ['options' => $exchanges, 'empty' => true]);
            echo $this->Form->input('timestamp');
            echo $this->Form->input('price');
            echo $this->Form->input('amount');
            echo $this->Form->input('tid');
            echo $this->Form->input('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
