<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $spotDepthPrice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $spotDepthPrice->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Spot Depth Prices'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="spotDepthPrices form large-10 medium-9 columns">
    <?= $this->Form->create($spotDepthPrice); ?>
    <fieldset>
        <legend><?= __('Edit Spot Depth Price') ?></legend>
        <?php
            echo $this->Form->input('exchange_id', ['options' => $exchanges, 'empty' => true]);
            echo $this->Form->input('timestamp');
            echo $this->Form->input('asks');
            echo $this->Form->input('bids');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
