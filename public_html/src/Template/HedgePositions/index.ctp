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
        $data = array();
    ?>
    <?php foreach ($hedgePositions as $hedgePosition):
        $currentPrice = $hedgePosition->getCurrentPrice();  
        
        $totalRealizedPL += $hedgePosition->getRealizedPL();
        $totalUnrealizedPL += $hedgePosition->getUnrealizedPL();
        
        $endingTime = date("Y-m-d H:i:s", strtotime("+7 days", strtotime($hedgePosition->timeopened)));
        if($hedgePosition->status == 0) {
            $endingTime = "-- N/A --";
        }
        
        $positionProfit = $hedgePosition->getRealizedPL() + $hedgePosition->getUnrealizedPL();

        if($positionProfit >= 0) {
            $rowBG = "#d0e9c6";                 // Success

        } else {
            $rowBG = "#fcf8e3";                // Warning
            
            if($positionProfit < 0 && $hedgePosition->status == 1) {
                $rowBG = "#f2dede";           // 
            }
        }

        $border = "";
        if($hedgePosition->status == 1) {
            $rowClass = " text-success ";
            // $border = "#8ad919";
        } else {
            $rowClass = " text-danger ";
            $rowBG = "#fcf8e3";
            // $border = "#f9243f";
            
        }
             
        
        ?>
        <tr class="<?= $rowClass ?>" style="background-color: <?= $rowBG ?>" >
            <!-- ID -->
            <td><?= $this->Number->format($hedgePosition->id) ?></td>
            <!-- Status -->
            <td><?= $hedgePosition->status == '1' ? '<strong class="text-success">OPEN</strong>' : '<strong class="text-danger">CLOSED</strong>' ?></td>
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
            <td>$<?= number_format($hedgePosition->openprice, 2) ?> </td>
            <!-- Open Positions: Current Price || Closed Positions: Closed Price. -->
            <td>$<?= number_format($currentPrice, 2); ?></td>
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
                        echo $this->Html->link(__('Close/Reopen'), ['action' => 'update', $hedgePosition->id]);
                    } 
                /* 
                <?= $this->Html->link(__('View'), ['action' => 'view', $hedgePosition->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hedgePosition->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hedgePosition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hedgePosition->id)]) ?>
                */ 
                ?>
            </td>
        </tr>

    <?php
            if($hedgePosition->status == 0) {
                $data['upl'][] = number_format($hedgePosition->openprice, 2);
                $data['rpl'][] = number_format($hedgePosition->closeprice, 2);
                $data['title'][] = $hedgePosition->exchange->name . " #:" . $hedgePosition->id;
            }
        endforeach;
        
        $data['upl'] = array_reverse($data['upl']);
        $data['rpl'] = array_reverse($data['rpl']);
        $data['title'] = array_reverse($data['title']);
    ?>
    </tbody>
    </table>
    
   
    <div class="panel panel-default">
        <div class="panel-heading">Open Price vs Closed Price (Closed Positions)</div>
        <div class="panel-body">
            <div class="canvas-wrapper">
                <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
var hedgePLData = {
    labels : <?= json_encode($data['title']) ?>,
   
    datasets : [
        {
            label: "Unrealized Profit/Loss",
            fillColor : "rgba(220,220,220,0.2)",
            strokeColor : "rgba(220,220,220,1)",
            pointColor : "rgba(220,220,220,1)",
            pointStrokeColor : "#fff",
            pointHighlightFill : "#fff",
            pointHighlightStroke : "rgba(220,220,220,1)",
            data : <?= json_encode($data['upl']); ?>
            
        },
        {
            label: "Realized Profit/Loss",
            fillColor : "rgba(48, 164, 255, 0.2)",
			strokeColor : "rgba(48, 164, 255, 0.8)",
			highlightFill : "rgba(48, 164, 255, 0.75)",
			highlightStroke : "rgba(48, 164, 255, 1)",
            data : <?= json_encode($data['rpl']); ?>
            
        }
    ]
}

window.onload = function() {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLineChart = new Chart(chart1).Line(hedgePLData, {
		responsive: true
	});
    
}
</script>
