<div class="pull-right actions columns col-lg-2 col-md-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Spot Ticker Price'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="spotTickerPrices index col-lg-10 col-md-9 columns">
Chart Here
</div>

<div class="spotTickerPrices index col-lg-10 col-md-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('exchange_id') ?></th>
            <th><?= $this->Paginator->sort('timestamp') ?></th>
            <th><?= $this->Paginator->sort('buy') ?></th>
            <th><?= $this->Paginator->sort('high') ?></th>
            <th><?= $this->Paginator->sort('last') ?></th>
            <th><?= $this->Paginator->sort('low') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($spotTickerPrices as $spotTickerPrice): ?>
        <tr>
            <td><?= $this->Number->format($spotTickerPrice->id) ?></td>
            <td>
                <?= $spotTickerPrice->has('exchange') ? $this->Html->link($spotTickerPrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $spotTickerPrice->exchange->id]) : '' ?>
            </td>
            <td><?= h($spotTickerPrice->timestamp) ?></td>
            <td><?= $this->Number->format($spotTickerPrice->buy) ?></td>
            <td><?= $this->Number->format($spotTickerPrice->high) ?></td>
            <td><?= $this->Number->format($spotTickerPrice->last) ?></td>
            <td><?= $this->Number->format($spotTickerPrice->low) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $spotTickerPrice->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $spotTickerPrice->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $spotTickerPrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $spotTickerPrice->id)]) ?>
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
