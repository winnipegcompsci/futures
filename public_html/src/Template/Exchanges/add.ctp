<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Exchanges'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hedge Positions'), ['controller' => 'HedgePositions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hedge Position'), ['controller' => 'HedgePositions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="exchanges form large-10 medium-9 columns">
    <?= $this->Form->create($exchange); ?>
    <fieldset>
        <legend><?= __('Add Exchange') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('apikey');
            echo $this->Form->input('secretkey');
            echo $this->Form->input('extras');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
