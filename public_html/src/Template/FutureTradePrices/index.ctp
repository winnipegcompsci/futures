<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Future Trade Price'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="futureTradePrices index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('exchange_id') ?></th>
            <th><?= $this->Paginator->sort('timestamp') ?></th>
            <th><?= $this->Paginator->sort('amount') ?></th>
            <th><?= $this->Paginator->sort('price') ?></th>
            <th><?= $this->Paginator->sort('tid') ?></th>
            <th><?= $this->Paginator->sort('type') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($futureTradePrices as $futureTradePrice): ?>
        <tr>
            <td><?= $this->Number->format($futureTradePrice->id) ?></td>
            <td>
                <?= $futureTradePrice->has('exchange') ? $this->Html->link($futureTradePrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $futureTradePrice->exchange->id]) : '' ?>
            </td>
            <td><?= h($futureTradePrice->timestamp) ?></td>
            <td><?= $this->Number->format($futureTradePrice->amount) ?></td>
            <td><?= $this->Number->format($futureTradePrice->price) ?></td>
            <td><?= $this->Number->format($futureTradePrice->tid) ?></td>
            <td><?= h($futureTradePrice->type) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $futureTradePrice->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $futureTradePrice->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $futureTradePrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $futureTradePrice->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
