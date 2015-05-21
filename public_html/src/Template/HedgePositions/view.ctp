<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Hedge Position'), ['action' => 'edit', $hedgePosition->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hedge Position'), ['action' => 'delete', $hedgePosition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hedgePosition->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hedge Positions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hedge Position'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="hedgePositions view large-10 medium-9 columns">
    <h2><?= h($hedgePosition->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Exchange') ?></h6>
            <p><?= $hedgePosition->has('exchange') ? $this->Html->link($hedgePosition->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $hedgePosition->exchange->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Bias') ?></h6>
            <p><?= h($hedgePosition->bias) ?></p>
            <h6 class="subheader"><?= __('Leverage') ?></h6>
            <p><?= h($hedgePosition->leverage) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($hedgePosition->id) ?></p>
            <h6 class="subheader"><?= __('Amount') ?></h6>
            <p><?= $this->Number->format($hedgePosition->amount) ?></p>
            <h6 class="subheader"><?= __('Ssp') ?></h6>
            <p><?= $this->Number->format($hedgePosition->ssp) ?></p>
            <h6 class="subheader"><?= __('Balance') ?></h6>
            <p><?= $this->Number->format($hedgePosition->balance) ?></p>
            <h6 class="subheader"><?= __('Lastprice') ?></h6>
            <p><?= $this->Number->format($hedgePosition->lastprice) ?></p>
            <h6 class="subheader"><?= __('Recalculation') ?></h6>
            <p><?= $this->Number->format($hedgePosition->recalculation) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Timeopened') ?></h6>
            <p><?= h($hedgePosition->timeopened) ?></p>
        </div>
    </div>
</div>
