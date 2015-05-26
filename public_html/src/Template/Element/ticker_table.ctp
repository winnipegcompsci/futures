<?php
use Cake\ORM\TableRegistry;

?>
<div class="panel-default">
    <div class="panel-heading">Bitcoin</div>
    <div class="panel-body">
        <table width="100%" id="btc_tickertable";>
            <thead>
            <tr>
                <th>Exchange</th>
                <th>Last</th>
                <th>Buy</th>
                <th>Sell</th>
                <th>Low</th>
                <th>High</th>
                <th>Volume</th>
            </tr>
            </thead>
            <tbody> 
            <?php
                $table = TableRegistry::get('Exchanges');
                $exchanges = $table->find('all');
            
                foreach($exchanges as $exchange) {
                    $ticker = $exchange->getTicker();
                    
                    echo "<tr>";
                    echo "<td>" . $exchange->name . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->last) ? $ticker->ticker->last : $ticker->last) . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->buy) ? $ticker->ticker->buy : $ticker->buy) . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->sell) ? $ticker->ticker->sell : $ticker->sell) . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->low) ? $ticker->ticker->low : $ticker->low) . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->high) ? $ticker->ticker->high : $ticker->high) . "</td>";
                    echo "<td>" . (isset($ticker->ticker->vol) ? $ticker->ticker->vol : $ticker->vol) . "</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="panel-default">
    <div class="panel-heading">Litecoin</div>
    <div class="panel-body">
        <table width="100%" id="btc_tickertable";>
            <thead>
            <tr>
                <th>Exchange</th>
                <th>Last</th>
                <th>Buy</th>
                <th>Sell</th>
                <th>Low</th>
                <th>High</th>
                <th>Volume</th>
            </tr>
            </thead>
            <tbody> 
            <?php
                $table = TableRegistry::get('Exchanges');
                $exchanges = $table->find('all');
            
                foreach($exchanges as $exchange) {
                    $ticker = $exchange->getLTCTicker();
                    
                    echo "<tr>";

                    echo "<td>" . $exchange->name . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->last) ? $ticker->ticker->last : $ticker->last) . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->buy) ? $ticker->ticker->buy : $ticker->buy) . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->sell) ? $ticker->ticker->sell : $ticker->sell) . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->low) ? $ticker->ticker->low : $ticker->low) . "</td>";
                    echo "<td>$" . (isset($ticker->ticker->high) ? $ticker->ticker->high : $ticker->high) . "</td>";
                    echo "<td>" . (isset($ticker->ticker->vol) ? $ticker->ticker->vol : $ticker->vol) . "</td>";
                     
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

