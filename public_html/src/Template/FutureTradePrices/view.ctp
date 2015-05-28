<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Future Trade Price'), ['action' => 'edit', $futureTradePrice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Future Trade Price'), ['action' => 'delete', $futureTradePrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $futureTradePrice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Future Trade Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Future Trade Price'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="futureTradePrices view large-10 medium-9 columns">
    <h2><?= h($futureTradePrice->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Exchange') ?></h6>
            <p><?= $futureTradePrice->has('exchange') ? $this->Html->link($futureTradePrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $futureTradePrice->exchange->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Type') ?></h6>
            <p><?= h($futureTradePrice->type) ?></p>
            <h6 class="subheader"><?= __('Contract Type') ?></h6>
            <p><?= h($futureTradePrice->contract_type) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($futureTradePrice->id) ?></p>
            <h6 class="subheader"><?= __('Amount') ?></h6>
            <p><?= $this->Number->format($futureTradePrice->amount) ?></p>
            <h6 class="subheader"><?= __('Price') ?></h6>
            <p><?= $this->Number->format($futureTradePrice->price) ?></p>
            <h6 class="subheader"><?= __('Tid') ?></h6>
            <p><?= $this->Number->format($futureTradePrice->tid) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Timestamp') ?></h6>
            <p><?= h($futureTradePrice->timestamp) ?></p>
        </div>
    </div>
</div>
