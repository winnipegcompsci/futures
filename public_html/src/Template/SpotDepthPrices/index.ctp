<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Spot Depth Price'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="spotDepthPrices index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('exchange_id') ?></th>
            <th><?= $this->Paginator->sort('timestamp') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($spotDepthPrices as $spotDepthPrice): ?>
        <tr>
            <td><?= $this->Number->format($spotDepthPrice->id) ?></td>
            <td>
                <?= $spotDepthPrice->has('exchange') ? $this->Html->link($spotDepthPrice->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $spotDepthPrice->exchange->id]) : '' ?>
            </td>
            <td><?= h($spotDepthPrice->timestamp) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $spotDepthPrice->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $spotDepthPrice->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $spotDepthPrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $spotDepthPrice->id)]) ?>
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
