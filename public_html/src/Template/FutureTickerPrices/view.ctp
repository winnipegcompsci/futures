<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Future Ticker Price'), ['action' => 'edit', $futureTickerPrice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Future Ticker Price'), ['action' => 'delete', $futureTickerPrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $futureTickerPrice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Future Ticker Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Future Ticker Price'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="futureTickerPrices view large-10 medium-9 columns">
    <h2><?= h($futureTickerPrice->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Exchange') ?></h6>
            <p><?= $futureTickerPrice->has('exchange') ? $this->Html->link($futureTickerPrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $futureTickerPrice->exchange->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Contract Type') ?></h6>
            <p><?= h($futureTickerPrice->contract_type) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($futureTickerPrice->id) ?></p>
            <h6 class="subheader"><?= __('Last') ?></h6>
            <p><?= $this->Number->format($futureTickerPrice->last) ?></p>
            <h6 class="subheader"><?= __('Buy') ?></h6>
            <p><?= $this->Number->format($futureTickerPrice->buy) ?></p>
            <h6 class="subheader"><?= __('Sell') ?></h6>
            <p><?= $this->Number->format($futureTickerPrice->sell) ?></p>
            <h6 class="subheader"><?= __('High') ?></h6>
            <p><?= $this->Number->format($futureTickerPrice->high) ?></p>
            <h6 class="subheader"><?= __('Low') ?></h6>
            <p><?= $this->Number->format($futureTickerPrice->low) ?></p>
            <h6 class="subheader"><?= __('Volume') ?></h6>
            <p><?= $this->Number->format($futureTickerPrice->volume) ?></p>
            <h6 class="subheader"><?= __('Contract') ?></h6>
            <p><?= $this->Number->format($futureTickerPrice->contract) ?></p>
            <h6 class="subheader"><?= __('Unit Amount') ?></h6>
            <p><?= $this->Number->format($futureTickerPrice->unit_amount) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Timestamp') ?></h6>
            <p><?= h($futureTickerPrice->timestamp) ?></p>
        </div>
    </div>
</div>
