<?php 
use Cake\ORM\TableRegistry;
?>

<div class="panel-default">
    <div class="panel-heading">Bitcoin</div>
    <div class="panel-body">
        <table width="100%" id="btc_depthtable";>
            <thead>
            <tr>
                <th>Exchange</th>
                <th>Data</th>
            </tr>
            </thead>
            <tbody> 
            <?php
                $table = TableRegistry::get('Exchanges');
                $exchanges = $table->find('all');
            
                foreach($exchanges as $exchange) {
                    $depth = $exchange->getDepth();
                    
                    echo "<tr>";
                    echo "<td>" . $exchange->name . "</td>";
                    echo "<td>" . "<pre>" . print_r($depth, TRUE) . "</pre>" . "</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

