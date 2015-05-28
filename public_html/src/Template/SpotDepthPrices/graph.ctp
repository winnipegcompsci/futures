<?php

foreach($graph_data as $name => $exchange) {
    ?>
    <div class="row">
        <h2> <?= str_replace('xchg_', '', $name) ?> </h2>
        <div class="columns col-lg-6 col-md-6 col-sm-6">
            <div class="panel-teal">
                <div class="panel-heading"><?= str_replace('xchg_', '', $name) ?> Market Depth - Bids </div>
                <div class="panel-body">
                    <canvas id="<?= $name ?>_asks_graph" width="700" height="400"></canvas>
                </div>
            </div>
        </div>
        
        <div class="columns col-lg-6 col-md-6 col-sm-6">
            <div class="panel-red">
                <div class="panel-heading"><?= str_replace('xchg_', '', $name) ?> Market Depth - Asks </div>
                <div class="panel-body">
                    <canvas id="<?= $name ?>_bids_graph" width="700" height="400"></canvas>
                </div>
            </div>    
        </div>
    </div>
    <?
}

/*
    <?php echo "<pre>" . print_r($exchange['bids'], TRUE) . "</pre>" ?>
    <?php echo "<pre>" . print_r($exchange['asks'], TRUE) . "</pre>" ?>
*/

?>

<script>
document.addEventListener("DOMContentLoaded", function(event) { 
<?php
foreach($graph_data as $name => $exchange_data) {
    ?>
    var options = {
        responsive : true,       
    };
    var <?=$name ?>_data = {
        labels: <?= json_encode($exchange_data['labels']) ?>,
        datasets: [
            {
                label: "Buy",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: <?= json_encode($exchange_data['bids']) ?>
            },
            {
                label: "Sell",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: <?= json_encode($exchange_data['asks']) ?>
            }
        ]
    };
    
    var atx = document.getElementById('<?= $name ?>_asks_graph').getContext("2d");
    var <?= $name . "_" ?>_ASKS_LineChart = new Chart(atx).Line(<?= $name ?>_data, options);
    
    var btx = document.getElementById('<?= $name ?>_bids_graph').getContext("2d");
    var <?= $name . "_" ?>_BIDS_LineChart = new Chart(btx).Line(<?= $name ?>_data, options);
 
<?php   
}// end foreachj
?>
});
</script>