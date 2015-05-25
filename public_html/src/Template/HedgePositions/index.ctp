<meta http-equiv="refresh" content="120" >

<div class="actions pull-right columns col-lg-2 col-md-3">
    <h4><?= __('Filter') ?></h4>
    <ul class="side-nav">
        <?php if(isset($_GET['status']) && $_GET['status'] == "all") { ?>
        <li><?= $this->Html->link(__('VIEW OPEN POSITIONS'), ['action' => 'index'] ); ?></li>
        <?php } else { ?>
        <li><?= $this->Html->link(__('VIEW ALL POSITIONS'), ['action' => 'index', '?' => ['status' => 'all'] ] ); ?></li>
        <?php } ?>
    </ul>

    <h4><?= __('Hide Table Columns') ?></h4>
    <ul class="side-nav">
        <li><a class="toggle-vis" data-column="0">ID</a></li>
        <li><a class="toggle-vis" data-column="1">Status</a></li>
        <li><a class="toggle-vis" data-column="2">Exchange</a></li>
        <li><a class="toggle-vis" data-column="3">Bias</a></li>
        <li><a class="toggle-vis" data-column="4">Amount</a></li>
        <li><a class="toggle-vis" data-column="5">SSP</a></li>
        <li><a class="toggle-vis" data-column="6">Leverage</a></li>
        <li><a class="toggle-vis" data-column="7">Opened At</a></li>
        <li><a class="toggle-vis" data-column="8">Current Price</a></li>
        <li><a class="toggle-vis" data-column="9">Unrealized PL</a></li>
        <li><a class="toggle-vis" data-column="10">Realized PL</a></li>
        <li><a class="toggle-vis" data-column="11">Recalculation Countdown</a></li>
        <li><a class="toggle-vis" data-column="12">Actions</a></li>   
    </ul>
    
    
    <h3><?= __('Actions') ?></h3>    
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Hedge Position'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exchanges'), ['controller' => 'Exchanges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exchange'), ['controller' => 'Exchanges', 'action' => 'add']) ?> </li>
    </ul>
</div>


<div class="row2">    
    <div class="columns col-lg-10 col-md-9 panel panel-default">
        <?php
            if(!isset($_GET['status']) || $_GET['status'] = "") {
                $panelTitle = "Unrealized Profit / Loss (Open Positions)";
            } else {
                $panelTitle = "Realized Profit / Loss (Closed Positions)";
            }
        ?>
        
        <div class="panel-heading"><?= $panelTitle ?></div>
        <div class="panel-body">
            <div class="canvas-wrapper">
                <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
            </div>
        </div>
    </div>        
</div>

<div class="row2">
    <div class="hedgePositions index col-lg-10 col-md-9 columns">        
        <table id="hedge_positions" cellpadding="0" cellspacing="0">
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
            $data = array();
        ?>
        <?php 

            $currentPrices = array();
            
            foreach ($hedgePositions as $hedgePosition):

            if(!isset($currentPrices[$hedgePosition->exchange_id])) {
                $currentPrices[$hedgePosition->exchange_id] = $hedgePosition->getCurrentPrice();  
            
            }
            $currentPrice = $currentPrices[$hedgePosition->exchange_id];
            
            // $endingTime = date("Y-m-d H:i:s", strtotime("+7 days", strtotime($hedgePosition->timeopened)));
            $endingTime = $hedgePosition->getTimeRemaining();
            
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
                            echo $this->Html->link(__('Close/Reopen'), ['action' => 'forceUpdate', $hedgePosition->id]);
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
                    $data['upl'][] = 0;
                    $data['rpl'][] = number_format($hedgePosition->getRealizedPL(), 8);
                    $data['title'][] = $hedgePosition->exchange->name . " - " . $hedgePosition->bias . " = " . $hedgePosition->amount .  " BTC @ " . number_format($hedgePosition->openprice, 2) . " sold @ " . number_format($hedgePosition->closeprice, 2);
                } else {
                    if(!isset($_GET['status']) || $_GET['status'] = "") {
                        $data['upl'][] = 0;
                        $data['rpl'][] = number_format($hedgePosition->getUnrealizedPL(), 8);
                        $data['title'][] = $hedgePosition->exchange->name . " - " . $hedgePosition->bias . " = " . $hedgePosition->amount . " BTC @ " . number_format($hedgePosition->openprice, 2) . " currently @ " . number_format($hedgePosition->getCurrentPrice(), 2);
                    }
                }
            endforeach;
            
            
        ?>
        </tbody>
        <tfoot>
        	<tr>
                <th colspan="9" style="text-align:right">Totals:</th>
                <th></th>   <!-- Unrealized PL -->
                <th></th>   <!-- Realized PL -->
                <th></th>   <!-- Reclaculation --> 
                <th></th>   <!-- Actions -->
            </tr>
        </tfoot>
        </table>
    </div>
</div>



<script>
var hedgePLData = {
    labels : <?= json_encode(array_reverse($data['title'])) ?>,
   
    datasets : [
        {
            label: "Unrealized Profit/Loss",
            fillColor : "rgba(220,220,220,0.2)",
            strokeColor : "rgba(220,220,220,1)",
            pointColor : "rgba(220,220,220,1)",
            pointStrokeColor : "#fff",
            pointHighlightFill : "#fff",
            pointHighlightStroke : "rgba(220,220,220,1)",
            data : <?= json_encode(array_reverse($data['upl'])); ?>
            
        },
        
        {
            label: "Realized Profit/Loss",
            fillColor : "rgba(48, 164, 255, 0.2)",
			strokeColor : "rgba(48, 164, 255, 0.8)",
			highlightFill : "rgba(48, 164, 255, 0.75)",
			highlightStroke : "rgba(48, 164, 255, 1)",
            data : <?= json_encode(array_reverse($data['rpl'])); ?>
            
        }
    ]
}

window.onload = function() {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLineChart = new Chart(chart1).Line(hedgePLData, {
		responsive: true,
	});
    
    
    var table = $('#hedge_positions').dataTable( {
        "order": [[0, "desc"],[1, "desc"]],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$\BTC,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 9 ).footer() ).html(
                pageTotal.toFixed(4) +' BTC ('+ total.toFixed(5) +' BTC total)'
            );
            ////////////////////////////////////////////////////////
            // Total over all pages
            total = api
                .column( 10)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 10 ).footer() ).html(
                '$'+pageTotal.toFixed(4) +' BTC ('+ total.toFixed(5) +' BTC total)'
            );
           
        }, // end footerCallback
        
    }); // end dataTable initialization
    
    // Hide Columns in Table.
    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
         
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
         
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
    
}


</script>
