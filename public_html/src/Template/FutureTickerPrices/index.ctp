<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Future Ticker Price'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="futureTickerPrices index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('exchange_id') ?></th>
            <th><?= $this->Paginator->sort('timestamp') ?></th>
            <th><?= $this->Paginator->sort('last') ?></th>
            <th><?= $this->Paginator->sort('buy') ?></th>
            <th><?= $this->Paginator->sort('sell') ?></th>
            <th><?= $this->Paginator->sort('high') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($futureTickerPrices as $futureTickerPrice): ?>
        <tr>
            <td><?= $this->Number->format($futureTickerPrice->id) ?></td>
            <td>
                <?= $futureTickerPrice->has('exchange') ? $this->Html->link($futureTickerPrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $futureTickerPrice->exchange->id]) : '' ?>
            </td>
            <td><?= h($futureTickerPrice->timestamp) ?></td>
            <td><?= $this->Number->format($futureTickerPrice->last) ?></td>
            <td><?= $this->Number->format($futureTickerPrice->buy) ?></td>
            <td><?= $this->Number->format($futureTickerPrice->sell) ?></td>
            <td><?= $this->Number->format($futureTickerPrice->high) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $futureTickerPrice->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $futureTickerPrice->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $futureTickerPrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $futureTickerPrice->id)]) ?>
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
