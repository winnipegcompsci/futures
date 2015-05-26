<div class="actions pull-right columns col-lg-2 col-md-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Exchange'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hedge Positions'), ['controller' => 'HedgePositions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hedge Position'), ['controller' => 'HedgePositions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="exchanges index col-lg-10 col-md-9 columns">
    <table width="100%" id="exchanges_table" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('apikey') ?></th>
            <th><?= $this->Paginator->sort('secretkey') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($exchanges as $exchange): ?>
        <tr>
            <td><?= $this->Number->format($exchange->id) ?></td>
            <td><?= h($exchange->name) ?></td>
            <td><?= h($exchange->apikey) ?></td>
            <td><?= h($exchange->secretkey) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $exchange->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $exchange->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $exchange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exchange->id)]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
</div>



