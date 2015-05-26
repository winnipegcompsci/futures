<?php 
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

?>
<!-- BUTTONS ROW -->
<div class="row">
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-blue panel-widget ">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left">
                    <em class="glyphicon glyphicon-shopping-cart glyphicon-l"></em>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <a href="<?= $this->Url->build(['controller' => 'pages', 'action' => 'contracts']); ?>"> 
                        <div class="large">120</div>
                        <div class="text-muted">New Futures Contracts</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-orange panel-widget">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left">
                    <em class="glyphicon glyphicon-comment glyphicon-l"></em>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <a href="<?= $this->Url->build(['controller' => 'pages', 'action' => 'transactions']); ?>">
                        <div class="large">52</div>
                        <div class="text-muted">Transactions Made</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-teal panel-widget">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left">
                    <em class="glyphicon glyphicon-user glyphicon-l"></em>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <a href="<?= $this->Url->build(['controller' => 'pages', 'action' => 'positions']); ?>">
                        <div class="large">24</div>
                        <div class="text-muted">Positions Held</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-red panel-widget">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left">
                    <em class="glyphicon glyphicon-stats glyphicon-l"></em>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <a href="<?= $this->Url->build(['controller' => 'pages', 'action' => 'profitandloss']); ?>">
                        <div class="large">25.2k</div>
                        <div class="text-muted">Profit/Loss</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- LARGE BTC Ticker Graph -->
<div class="row">
	<div class="col-xs-12 col-md-6 col-lg-9">
        <div class="panel panel-info">
			<div class="panel-body tabs">
                <ul class="nav nav-pills">
					<li class="active"><a href="#tab1" data-toggle="tab" onclick="redraw()">Tickers</a></li>
					<li><a href="#tab2" data-toggle="tab" onclick="redraw()">Market Depth</a></li>
                    <li><a href="#tab3" data-toggle="tab" onclick="redraw()">Trade History</a></li>
                    <li class="pull-right"><span><h3>Exchange Details</h3></span></li>
				</ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                        <div class="canvas-wrapper">
                            <?= $this->element('ticker_table'); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <div class="canvas-wrapper">
                            <?= $this->element('depth_table'); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="btc-chart" height="200" width="600"></canvas>
                        </div>
                    </div>
                </div>
			</div>
        </div>
	</div>
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="row">
            <div class="panel-default">
                <div class="panel-heading">Last Positions Closed </div>
                <div class="panel-body">
                    -- Recent Positions Element --
                </div>
            </div>
        </div>
    </div>
</div>
 

<!-- Pie Charts --> 
<div class="row">
    <div class="col-xs-6 col-md-3">
        <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
                <h4>Slippage Stop Percentage:</h4>
                <div class="easypiechart" id="easypiechart-red" data-percent="27"><span class="percent">27%</span>
                <!--<canvas height="110" width="110"></canvas>--></div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-md-3">
        <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
                <h4>Cover Ratio:</h4>
                <div class="easypiechart" id="easypiechart-teal" data-percent="56"><span class="percent">56%</span>
                <!--<canvas height="110" width="110"></canvas>--></div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-md-3">
        <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
                <h4>Position Bias (Long):</h4>
                <div class="easypiechart" id="easypiechart-orange" data-percent="65"><span class="percent">65%</span>
                <!--<canvas height="110" width="110"></canvas>--></div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-md-3">
        <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
                <h4>Recalculation Period:</h4>
                <div class="easypiechart" id="easypiechart-blue" data-percent="92"><span class="percent">92%</span>
                <!--<canvas height="110" width="110"></canvas>--></div>
            </div>
        </div>
    </div>
</div>



<script> 	 
window.onload = function() {	
    $(document).ready(function() { 	 	
        $('#btc_tickertable').dataTable({
            "pagingType": "full",
        });  
    }); 	
} 	
</script>

<script>       
window.onload = function(){  
    $(function() {
        $('#easypiechart-teal').easyPieChart({
            scaleColor: false,
            barColor: '#1ebfae'
        });
    });

    $(function() {
        $('#easypiechart-orange').easyPieChart({
            scaleColor: false,
            barColor: '#ffb53e'
        });
    });

    $(function() {
        $('#easypiechart-red').easyPieChart({
            scaleColor: false,
            barColor: '#f9243f'
        });
    });

    $(function() {
       $('#easypiechart-blue').easyPieChart({
           scaleColor: false,
           barColor: '#30a5ff'
       });
    });
}
</script>