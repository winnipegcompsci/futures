<?php 
foreach($graph_data as $name => $exchange_data) {
    ?>
    <div class="row">
        <div class="columns col-lg-10 col-md-9 col-sm-6">
            <div class="panel-default">
                <div class="panel-heading"><?= str_replace('xchg_', '', $name) ?> Futures Ticker</div>
                <div class="panel-body">
                    <canvas id="<?= $name ?>_graph" width="700" height="400"></canvas>

                </div>
            </div>
        </div>
        <div class="columns col-lg-2 col-md-3 col-sm-6">
            <div class="row">
                <div class="panel-teal">
                    <div class="panel-heading">Account Balance</div>
                    <div class="panel-body">
                    
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="panel-blue">
                    <div class="panel-heading">Buy Order</div>
                    <div class="panel-body">
                    
                    </div>
                </div>
            </div>
            
            <div class="row">
            <div class="panel-red">
                    <div class="panel-heading">Sell Order</div>
                    <div class="panel-body">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php 
}
?>


<script>
document.addEventListener("DOMContentLoaded", function(event) { 
<?php
foreach($graph_data as $name => $exchange_data) {
    $lables = array();
    
    foreach($exchange_data['timestamp'] as $t)
    {
        $labels[] = date("Y-m-d H:i:s", $t);
    }
    ?>
    var options = {
        responsive : true,       
    };
    var <?=$name ?>_data = {
        labels: <?= json_encode($labels) ?>,
        datasets: [
            {
                label: "Buy",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: <?= json_encode($exchange_data['buy']) ?>
            },
            {
                label: "Sell",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: <?= json_encode($exchange_data['sell']) ?>
            }
        ]
    };
    
    var ctx = document.getElementById('<?= $name ?>_graph').getContext("2d");
    var <?= $name . "_" ?>LineChart = new Chart(ctx).Line(<?= $name ?>_data, options);
 
<?php   
} // end foreachj
?>
});

</script>