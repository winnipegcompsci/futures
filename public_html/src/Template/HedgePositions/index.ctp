<div class="actions pull-right columns col-lg-2 col-md-3">
    <h3><?= __('Filter') ?></h3>
    <ul class="side-nav">
        <?php if(isset($_GET['status']) && $_GET['status'] == "all") { ?>
        <li><?= $this->Html->link(__('VIEW OPEN POSITIONS'), ['action' => 'index'] ); ?></li>
        <?php } else { ?>
        <li><?= $this->Html->link(__('VIEW ALL POSITIONS'), ['action' => 'index', '?' => ['status' => 'all'] ] ); ?></li>
        <?php } ?>
    </ul>

    <h3><?= __('Actions') ?></h3>    
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Hedge Position'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>

<div class="hedgePositions index col-lg-10 col-md-9 columns">        
    <table id="datatable" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Exchange</th>
            <th>Bias</th>
            <th>Amount</th>
            <th>SSP</th>
            <th>Leverage</th>
            <th>Opened at</th>
            <th>Current Price</th>
            <th>Unrealized PL</th>
            <th>Realized PL</th>
            <th>Recalculation</th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $totalRealizedPL = 0;
        $totalUnrealizedPL = 0;
    ?>
    <?php foreach ($hedgePositions as $hedgePosition):
        $currentPrice = $hedgePosition->getCurrentPrice();
                
        
        $totalRealizedPL += $hedgePosition->getRealizedPL();
        $totalUnrealizedPL += $hedgePosition->getUnrealizedPL();
        
        $endingTime = date("Y-m-d H:i:s", strtotime("+7 days", strtotime($hedgePosition->timeopened)));
        if($hedgePosition->status == 0) {
            $endingTime = "-- N/A --";
        }
        
        ?>
        <tr class="<?php echo $hedgePosition->status == 1 ? 'text-success' : 'text-danger' ?>">
            <!-- ID -->
            <td><?= $this->Number->format($hedgePosition->id) ?></td>
            <!-- Status -->
            <td><?= $hedgePosition->status == '1' ? 'OPEN' : 'CLOSED' ?></td>
            <!-- Exchange Name -->
            <td>
                <?= $hedgePosition->has('exchange') ? $this->Html->link($hedgePosition->exchange->name, ['controller' => 'Exchanges', 'action' => 'view', $hedgePosition->exchange->id]) : '' ?>
            </td>
            <!-- Position Bias -->
            <td><?= h($hedgePosition->bias) ?></td>
            <!-- Amount Hedged -->
            <td><?= $this->Number->format($hedgePosition->amount) ?> BTC</td>
            <!-- Slippage Stop Point -->
            <td><?= $this->Number->format($hedgePosition->ssp*100) ?>%</td>
            <!-- Leverage -->
            <td><?= h($hedgePosition->leverage) ?>X</td>
            <!-- Price Opened at. -->
            <td>$<?= $this->Number->format($hedgePosition->openprice) ?> </td>
            <!-- Open Positions: Current Price || Closed Positions: Closed Price. -->
            <td>$<?= $this->Number->format($currentPrice); ?></td>
            <!-- Unrealized PL -->
            <td><?= number_format($hedgePosition->getUnrealizedPL(), 6); ?> BTC</td>
            <!-- Realized PL -->
            <td><?= number_format($hedgePosition->getRealizedPL(), 6);  ?> BTC</td>
            <!-- Recalculation Countdown -->
            <td><?= $endingTime ?></td>
            <!-- Actions -->
            <td class="actions">
                <?php 
                    if($hedgePosition->status != 0) { 
                        echo $this->Html->link(__('Update'), ['action' => 'update', $hedgePosition->id]);
                    } 
                ?>
                <?php /* 
                <?= $this->Html->link(__('View'), ['action' => 'view', $hedgePosition->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hedgePosition->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hedgePosition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hedgePosition->id)]) ?>
                */ ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
</div>

<div class="results columns col-lg-10 col-md-9">
    <table width="40%" class="pull-right">
        <tr>
            <th class="text-center" colspan=2> Results </th>
        </tr>
        <tr class="<?php echo $totalUnrealizedPL >= 0 ? 'text-success' : 'text-danger' ?>">
            <td>Total Unrealized Profit:</td> <td class="pull-right"><?= number_format($totalUnrealizedPL, 8) ?> BTC </td>
        </tr>
        <tr class="<?php echo $totalRealizedPL >= 0 ? 'text-success' : 'text-danger' ?>">
            <td>Total Realized Profit:</td> <td class="pull-right"><?= number_format($totalRealizedPL, 8) ?> BTC </td>
        </tr>
        <tr class="<?php echo $totalUnrealizedPL + $totalRealizedPL >= 0 ? 'text-success' : 'text-danger' ?>">
            <td>Total Profit</td> <td class="pull-right"><?= number_format($totalUnrealizedPL + $totalRealizedPL, 8); ?> BTC </td>
        </tr>        
    </table>

</div>