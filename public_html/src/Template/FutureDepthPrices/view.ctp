<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Future Depth Price'), ['action' => 'edit', $futureDepthPrice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Future Depth Price'), ['action' => 'delete', $futureDepthPrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $futureDepthPrice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Future Depth Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Future Depth Price'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="futureDepthPrices view large-10 medium-9 columns">
    <h2><?= h($futureDepthPrice->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Exchange') ?></h6>
            <p><?= $futureDepthPrice->has('exchange') ? $this->Html->link($futureDepthPrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $futureDepthPrice->exchange->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Contract Type') ?></h6>
            <p><?= h($futureDepthPrice->contract_type) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($futureDepthPrice->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Timestamp') ?></h6>
            <p><?= h($futureDepthPrice->timestamp) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Asks') ?></h6>
            <?= $this->Text->autoParagraph(h($futureDepthPrice->asks)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Bids') ?></h6>
            <?= $this->Text->autoParagraph(h($futureDepthPrice->bids)); ?>

        </div>
    </div>
</div>
