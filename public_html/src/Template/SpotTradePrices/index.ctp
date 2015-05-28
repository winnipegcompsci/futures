<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Spot Trade Price'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="spotTradePrices index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('exchange_id') ?></th>
            <th><?= $this->Paginator->sort('timestamp') ?></th>
            <th><?= $this->Paginator->sort('price') ?></th>
            <th><?= $this->Paginator->sort('amount') ?></th>
            <th><?= $this->Paginator->sort('tid') ?></th>
            <th><?= $this->Paginator->sort('type') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($spotTradePrices as $spotTradePrice): ?>
        <tr>
            <td><?= $this->Number->format($spotTradePrice->id) ?></td>
            <td>
                <?= $spotTradePrice->has('exchange') ? $this->Html->link($spotTradePrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $spotTradePrice->exchange->id]) : '' ?>
            </td>
            <td><?= h($spotTradePrice->timestamp) ?></td>
            <td><?= $this->Number->format($spotTradePrice->price) ?></td>
            <td><?= $this->Number->format($spotTradePrice->amount) ?></td>
            <td><?= $this->Number->format($spotTradePrice->tid) ?></td>
            <td><?= h($spotTradePrice->type) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $spotTradePrice->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $spotTradePrice->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $spotTradePrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $spotTradePrice->id)]) ?>
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
