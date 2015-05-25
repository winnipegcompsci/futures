<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Network\Http\Client;
use Cake\ORM\TableRegistry;
use Cake\Error\Debugger;

/**
 * HedgePosition Entity.
 */
class HedgePosition extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
     
    protected $cachedCurrentPrice = array(); 
    protected $lastUpdated = array();
     
    protected $_accessible = [
        'exchange_id' => true,
        'bias' => true,
        'amount' => true,
        'ssp' => true,
        'leverage' => true,
        'balance' => true,
        'openprice' => true,
        'closeprice' => true,
        'timeopened' => true,
        'recalculation' => true,
        'status' => true,
        'exchange' => true,
    ];
        
    public function getCurrentPrice($exchange = null) {
        if((!isset($this->cachedCurrentPrice[$this->exchange_id]) || !isset($this->lastUpdated[$this->exchange_id])) || abs(strtotime("now") - $this->lastUpdated[$this->exchange_id]) > 5) {
            $this->lastUpdated[$this->exchange_id] = strtotime("now");
                
            if($exchange == null) {
                $exchanges = TableRegistry::get('exchanges')->findById($this->exchange_id);
                            
                foreach($exchanges as $xchg) {
                    $exchange = $xchg->name;
                }               
            }
        
            if($this->status == 0) {
                return $this->closeprice;
            }
        
            $http = new Client();
            
            if($exchange == "OKCOIN") {
                error_log('SENDING GET REQUEST TO OKCOIN');
                $ticker = json_decode($http->get('https://www.okcoin.com/api/v1/ticker.do?symbol=btc_usd')->body);
                $this->cachedCurrentPrice[$this->exchange_id] = $ticker->ticker->buy;
                return $ticker->ticker->buy;
                
            } else if ($exchange == "796") {
                error_log('SENDING GET REQUEST TO 796');
                $ticker = json_decode($http->get('http://api.796.com/v3/futures/ticker.html?type=weekly')->body);
                $this->cachedCurrentPrice[$this->exchange_id] = $ticker->ticker->buy;
                return $ticker->ticker->buy;
                
            } else if ($exchange == "BITVC") {
                return 0;
            }
        } else {
            return $this->cachedCurrentPrice[$this->exchange_id];
        }
    } // end getCurrentPrice()
    
    
    public function getUnrealizedPL() {
        
        if((!isset($this->lastUpdated[$this->exchange_id]) || 
            !isset($this->cachedCurrentPrice[$this->exchange_id])) || 
                abs(strtotime("now") - $this->lastUpdated[$this->exchange_id]) > 5) {
                $CURRENT_PRICE = $this->getCurrentPrice();
        } else {
            $CURRENT_PRICE = $this->cachedCurrentPrice[$this->exchange_id];
        }
    
        if($this->bias == "LONG") {
            // If Position if Closed.
            if ($this->status == "1") {             // Calculate  from Starting Price to Current Price.
                $unrealizedPL = (($CURRENT_PRICE - $this->openprice) * $this->amount) / $CURRENT_PRICE;
            } else {
                return 0;
            }
            
        }     
        else if ($this->bias == "SHORT") {
            if ($this->status == "1") {      // Calculate from Starting to Closed Price.
                $unrealizedPL = (($this->openprice - $CURRENT_PRICE) * $this->amount) / $CURRENT_PRICE;
            } else {
                return 0;
            }
        }
        
        return  $unrealizedPL;
    }
    
    public function getRealizedPL() {
        
        if((!isset($this->cachedCurrentPrice[$this->exchange_id]) || !isset($this->lastUpdated[$this->exchange_id])) || 
            abs(strtotime("now") - $this->lastUpdated[$this->exchange_id]) > 5) {
            $CURRENT_PRICE = $this->getCurrentPrice();
        } else {
            $CURRENT_PRICE = $this->cachedCurrentPrice[$this->exchange_id];
        }
    
        if($this->bias == "LONG") {
            // If Position if Closed.
            if($this->status == "0") {              // Calculate from Starting to Closed Price.
                $realizedPL = (($this->closeprice - $this->openprice) * $this->amount) / $this->closeprice;
            } else if ($this->status == "1") {      // Calculate  from Starting Price to Current Price.
                $realizedPL = 0;
            }
            
        }
        else if ($this->bias == "SHORT") {
            if($this->status == "0") {              // Calculate from Starting to Closed Price
                $realizedPL = (($this->openprice - $this->closeprice) * $this->amount) / $this->closeprice;
            } else if ($this->status == "1") {      // Calculate from Starting to Current Price.
                $realizedPL = 0;
            }
        }
        
        return $realizedPL;
    }
    
    public function forceUpdate($id) {
        $this->update($id, TRUE);
    }
    
    public function update($id = null, $force = FALSE) 
    {
        $this->HedgePositions = TableRegistry::get('HedgePositions');
        
        error_log("Update Script Called on Hedge #" . $this->id);
        $hedgePosition = $this;
        
        $openingPrice = $hedgePosition->openprice;
        $currentPrice = $hedgePosition->getCurrentPrice();
               
        $minBound = $hedgePosition->openprice - ($hedgePosition->openprice * $hedgePosition->ssp);
        $maxBound = $hedgePosition->openprice + ($hedgePosition->openprice * $hedgePosition->ssp);
               
        // Recalculate Stops.
        if($hedgePosition->bias == "LONG") {
            if($force == TRUE || $currentPrice < $minBound) {            
                // Close Position and Reopen at Current Price.
                $output = "<br /><strong>Closing Long Position at " . $hedgePosition->lastprice . " and re-opening at " . $currentPrice . "</strong>";
            
                $unrealizedPL = (($currentPrice - $hedgePosition->openprice) * $hedgePosition->amount) / $currentPrice;
                
                // Update Old Hedge Position
                $hedgePosition->balance = $unrealizedPL;            
                $hedgePosition->closeprice = $currentPrice;
                $hedgePosition->status = 0;
                $this->HedgePositions->save($hedgePosition);
                
                $newPosition = $this->HedgePositions->newEntity();
                
                $newPosition->exchange_id = $hedgePosition->exchange_id;
                $newPosition->bias = $hedgePosition->bias;
                $newPosition->amount = $hedgePosition->amount;
                $newPosition->ssp = $hedgePosition->ssp;
                $newPosition->leverage = $hedgePosition->leverage;
                $newPosition->balance = $hedgePosition->amount;
                $newPosition->openprice = $currentPrice;
                $newPosition->timeopened = date("Y-m-d H:i:s");
                $newPosition->recalculation = $hedgePosition->recalculation;                
                
                if ($this->HedgePositions->save($newPosition)) {
                    error_log("Old Position Closed, New Position Created");
                    return true;
                } else {
                    error_log("Error: The hedge could not be Saved!");
                    return false;
                }
 
            } else {
                // else hold onto position
                error_log("Holding on to Position");
                return false;
            }
                       
            return false;
            
        }
        
        if ($hedgePosition->bias == "SHORT") {
            if($force == TRUE || $currentPrice > $maxBound ) {
                // Close Position and Reopen at Current Price.
                    
                $unrealizedPL = (($hedgePosition->lastprice - $currentPrice) * $hedgePosition->amount) / $currentPrice;
                
                // Update Position
                $hedgePosition->balance = $unrealizedPL;
                $hedgePosition->status = 0;
                $hedgePosition->closeprice = $currentPrice;
                $this->HedgePositions->save($hedgePosition);
                
                $newPosition = $this->HedgePositions->newEntity();
                
                $newPosition->exchange_id = $hedgePosition->exchange_id;
                $newPosition->bias = $hedgePosition->bias;
                $newPosition->amount = $hedgePosition->amount;
                $newPosition->ssp = $hedgePosition->ssp;
                $newPosition->leverage = $hedgePosition->leverage;
                $newPosition->balance = $hedgePosition->amount;
                $newPosition->openprice = $currentPrice;
                $newPosition->timeopened = date("Y-m-d H:i:s");
                $newPosition->recalculation = $hedgePosition->recalculation;   
                   
                if ($this->HedgePositions->save($newPosition)) {
                    error_log("Old Position Closed, New Position Created");
                    return true;
                } else {
                    error_log("Error: The hedge could not be Saved!");
                    return false;
                }
            } else {
                // else hold onto position.
                error_log("Holding on to Position");
                return false;
            }
        }
        
        return false;
    } // end update
}
