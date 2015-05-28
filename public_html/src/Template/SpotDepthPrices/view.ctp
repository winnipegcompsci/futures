<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Spot Depth Price'), ['action' => 'edit', $spotDepthPrice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Spot Depth Price'), ['action' => 'delete', $spotDepthPrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $spotDepthPrice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Spot Depth Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Spot Depth Price'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="spotDepthPrices view large-10 medium-9 columns">
    <h2><?= h($spotDepthPrice->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Exchange') ?></h6>
            <p><?= $spotDepthPrice->has('exchange') ? $this->Html->link($spotDepthPrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $spotDepthPrice->exchange->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($spotDepthPrice->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Timestamp') ?></h6>
            <p><?= h($spotDepthPrice->timestamp) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Asks') ?></h6>
            <?= $this->Text->autoParagraph(h($spotDepthPrice->asks)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Bids') ?></h6>
            <?= $this->Text->autoParagraph(h($spotDepthPrice->bids)); ?>

        </div>
    </div>
</div>
