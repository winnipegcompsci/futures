<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Exchange'), ['action' => 'edit', $exchange->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exchange'), ['action' => 'delete', $exchange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exchange->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exchanges'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hedge Positions'), ['controller' => 'HedgePositions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hedge Position'), ['controller' => 'HedgePositions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="exchanges view large-10 medium-9 columns">
    <h2><?= h($exchange->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($exchange->name) ?></p>
            <h6 class="subheader"><?= __('Apikey') ?></h6>
            <p><?= h($exchange->apikey) ?></p>
            <h6 class="subheader"><?= __('Secretkey') ?></h6>
            <p><?= h($exchange->secretkey) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($exchange->id) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Extras') ?></h6>
            <?= $this->Text->autoParagraph(h($exchange->extras)); ?>

        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related HedgePositions') ?></h4>
    <?php if (!empty($exchange->hedge_positions)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Exchange Id') ?></th>
            <th><?= __('Bias') ?></th>
            <th><?= __('Amount') ?></th>
            <th><?= __('Ssp') ?></th>
            <th><?= __('Leverage') ?></th>
            <th><?= __('Balance') ?></th>
            <th><?= __('Lastprice') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($exchange->hedge_positions as $hedgePositions): ?>
        <tr>
            <td><?= h($hedgePositions->id) ?></td>
            <td><?= h($hedgePositions->exchange_id) ?></td>
            <td><?= h($hedgePositions->bias) ?></td>
            <td><?= h($hedgePositions->amount) ?></td>
            <td><?= h($hedgePositions->ssp) ?></td>
            <td><?= h($hedgePositions->leverage) ?></td>
            <td><?= h($hedgePositions->balance) ?></td>
            <td><?= h($hedgePositions->lastprice) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'HedgePositions', 'action' => 'view', $hedgePositions->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'HedgePositions', 'action' => 'edit', $hedgePositions->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'HedgePositions', 'action' => 'delete', $hedgePositions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hedgePositions->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
