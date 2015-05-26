<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Network\Http\Client;
use Cake\ORM\TableRegistry;

/**
 * Exchange Entity.
 */
class Exchange extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
     
    protected $lastUpdated = array();
     
    protected $_accessible = [
        'name' => true,
        'apikey' => true,
        'secretkey' => true,
        'extras' => true,
        'hedge_positions' => true,
    ];
    
    public function getTicker() {
        if(!isset($this->cachedTicker) || abs(strtotime("now") - $this->lastUpdated['ticker']) > 5) {
            $this->lastUpdated['ticker'] = strtotime("now");
                
          
            $http = new Client();
            
            if(strtoupper($this->name) == "OKCOIN") {
                $ticker = json_decode($http->get('https://www.okcoin.com/api/v1/ticker.do?symbol=btc_usd')->body);
                $this->cachedTicker = $ticker;
                return $ticker;
                
            } else if (strtoupper($this->name) == "796") {
                $ticker = json_decode($http->get('http://api.796.com/v3/futures/ticker.html?type=weekly')->body);
                $this->cachedTicker = $ticker;
                return $ticker;
                
            } else if (strtoupper($this->name) == "BITVC") {
                $ticker = json_decode($http->get('http://market.bitvc.com/futures/ticker_btc_week.js')->body);
                error_log("BITVC DEBUG:::: <pre>" . print_r($ticker, TRUE) . "</pre>");
                $this->cachedTicker = $ticker;
                return $ticker;
            }
        } else {
            return $this->cachedTicker;
        }
    } // end getTicker()
    
    public function getLTCTicker() {
         if(!isset($this->cachedLTCTicker) || abs(strtotime("now") - $this->lastUpdated['ltcticker']) > 5) {
            $this->lastUpdated['ltcticker'] = strtotime("now");
                
          
            $http = new Client();
            
            if(strtoupper($this->name) == "OKCOIN") {
                $ticker = json_decode($http->get('https://www.okcoin.com/api/v1/ticker.do?symbol=ltc_usd')->body);
                $this->cachedLTCTicker = $ticker;
                return $ticker;
                
            } else if (strtoupper($this->name) == "796") {
                $ticker = json_decode($http->get('http://api.796.com/v3/futures/ticker.html?type=ltc')->body);
                $this->cachedLTCTicker = $ticker;
                return $ticker;
                
            } else if (strtoupper($this->name) == "BITVC") {
                $ticker = json_decode($http->get('http://market.bitvc.com/futures/ticker_ltc_week.js')->body);
                $this->cachedLTCTicker = $ticker;
                return $ticker;
            }
        } else {
            return $this->cachedLTCTicker;
        }
    }
    
    
    public function getDepth() {
        if(!isset($this->cachedDepth) || abs(strtotime("now") - $this->lastUpdated['depth']) > 60) {
            $this->lastUpdated['depth'] = strtotime("now");
                
          
            $http = new Client();
            
            if(strtoupper($this->name) == "OKCOIN") {
                $depth = json_decode($http->get('https://www.okcoin.com/api/v1/depth.do?symbol=btc_usd')->body);
                $this->cachedDepth = $depth;
                return $depth;
            } else if (strtoupper($this->name) == "796") {
                $depth = json_decode($http->get('http://api.796.com/v3/futures/depth.html?type=weekly')->body);              
                $this->cachedDepth = $depth;
                return $depth;
            } else if (strtoupper($this->name) == "BITVC") {
                $depth = json_decode($http->get('http://market.bitvc.com/futures/depths_btc_week.js')->body);
                $this->cachedDepth = $depth;
                return $depth;
            }
        } else {
            return $this->cachedDepth;
        }
    }
    
    public function getTradeHistory() {
        if(!isset($this->cachedTrades) || abs(strtotime("now") - $this->lastUpdated['trades']) > 60) {
            $this->lastUpdated['trades'] = strtotime("now");
                
          
            $http = new Client();
            
            if(strtoupper($this->name) == "OKCOIN") {
                $trades = json_decode($http->get('https://www.okcoin.com/api/v1/depth.do?symbol=btc_usd')->body);
                $this->cachedTrades = $trades;
                return $trades;
            } else if (strtoupper($this->name) == "796") {
                $trades = json_decode($http->get('http://api.796.com/v3/futures/depth.html?type=weekly')->body);              
                $this->cachedTrades = $trades;
                return $trades;
            } else if (strtoupper($this->name) == "BITVC") {
                $trades = json_decode($http->get('http://market.bitvc.com/futures/depths_btc_week.js')->body);
                $this->cachedTrades = $trades;
                return $trades;
            }
        } else {
            return $this->cachedTrades;
        }
    }    
}
