<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Spot Trade Price'), ['action' => 'edit', $spotTradePrice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Spot Trade Price'), ['action' => 'delete', $spotTradePrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $spotTradePrice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Spot Trade Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Spot Trade Price'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="spotTradePrices view large-10 medium-9 columns">
    <h2><?= h($spotTradePrice->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Exchange') ?></h6>
            <p><?= $spotTradePrice->has('exchange') ? $this->Html->link($spotTradePrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $spotTradePrice->exchange->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Type') ?></h6>
            <p><?= h($spotTradePrice->type) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($spotTradePrice->id) ?></p>
            <h6 class="subheader"><?= __('Price') ?></h6>
            <p><?= $this->Number->format($spotTradePrice->price) ?></p>
            <h6 class="subheader"><?= __('Amount') ?></h6>
            <p><?= $this->Number->format($spotTradePrice->amount) ?></p>
            <h6 class="subheader"><?= __('Tid') ?></h6>
            <p><?= $this->Number->format($spotTradePrice->tid) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Timestamp') ?></h6>
            <p><?= h($spotTradePrice->timestamp) ?></p>
        </div>
    </div>
</div>
