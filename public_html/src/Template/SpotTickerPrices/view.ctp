<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Spot Ticker Price'), ['action' => 'edit', $spotTickerPrice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Spot Ticker Price'), ['action' => 'delete', $spotTickerPrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $spotTickerPrice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Spot Ticker Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Spot Ticker Price'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="spotTickerPrices view large-10 medium-9 columns">
    <h2><?= h($spotTickerPrice->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Exchange') ?></h6>
            <p><?= $spotTickerPrice->has('exchange') ? $this->Html->link($spotTickerPrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $spotTickerPrice->exchange->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($spotTickerPrice->id) ?></p>
            <h6 class="subheader"><?= __('Buy') ?></h6>
            <p><?= $this->Number->format($spotTickerPrice->buy) ?></p>
            <h6 class="subheader"><?= __('High') ?></h6>
            <p><?= $this->Number->format($spotTickerPrice->high) ?></p>
            <h6 class="subheader"><?= __('Last') ?></h6>
            <p><?= $this->Number->format($spotTickerPrice->last) ?></p>
            <h6 class="subheader"><?= __('Low') ?></h6>
            <p><?= $this->Number->format($spotTickerPrice->low) ?></p>
            <h6 class="subheader"><?= __('Sell') ?></h6>
            <p><?= $this->Number->format($spotTickerPrice->sell) ?></p>
            <h6 class="subheader"><?= __('Vol') ?></h6>
            <p><?= $this->Number->format($spotTickerPrice->vol) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Timestamp') ?></h6>
            <p><?= h($spotTickerPrice->timestamp) ?></p>
        </div>
    </div>
</div>
