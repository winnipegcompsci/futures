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
    
    public function saveSpotTickerData() {
        $http = new Client();

        $spotpricesTable = TableRegistry::get('SpotTickerPrices');
        
        $spotprice = $spotpricesTable->newEntity();
        
        
        if(strtoupper($this->name) == "OKCOIN") {
            $ticker = json_decode($http->get('https://www.okcoin.com/api/v1/ticker.do?symbol=btc_usd')->body);
                        
            $spotprice->exchange_id = $this->id;
            $spotprice->timestamp = time();
            $spotprice->buy = $ticker->ticker->buy;
            $spotprice->high = $ticker->ticker->high;
            $spotprice->last = $ticker->ticker->last;
            $spotprice->low = $ticker->ticker->low;
            $spotprice->sell = $ticker->ticker->sell;
            $spotprice->vol = $ticker->ticker->vol;
            
        } else if (strtoupper($this->name) == "796") {
            $ticker = json_decode($http->get('http://api.796.com/v3/stock/ticker.html?type=mri')->body);
            
            $spotprice->exchange_id = $this->id;
            $spotprice->timestamp = time();
            $spotprice->buy = $ticker->ticker->buy;
            $spotprice->high = $ticker->ticker->high;
            $spotprice->last = $ticker->ticker->last;
            $spotprice->low = $ticker->ticker->low;
            $spotprice->sell = $ticker->ticker->sell;
            $spotprice->vol = $ticker->ticker->vol;
        } else if (strtoupper($this->name) == "BITVC") {
           // BIT VC Doesn't Have Spot Ticker?
        }
        
        // Save
        if($spotpricesTable->save($spotprice)) {
            error_log("Saved " . $this->name . "'s Ticker Spot Prices");
        } else {
            error_log("Failed to Save " . $this->name . "'s Spot Ticker Prices");
        }   
    }
    
    public function saveFutureTickerData() {
        $http = new Client();

        $futureTickerTable = TableRegistry::get('FutureTickerPrices');
        $futurePrice = $futureTickerTable->newEntity();
        $futurePrice->exchange_id = $this->id;
        
        if(strtoupper($this->name) == "OKCOIN") {
            $ticker = json_decode($http->get('https://www.okcoin.com/api/v1/future_ticker.do?symbol=btc_usd&contract_type=this_week')->body);
            $futurePrice->timestamp = time();
            $futurePrice->last = $ticker->ticker->last;
            $futurePrice->buy = $ticker->ticker->buy;
            $futurePrice->sell = $ticker->ticker->sell;
            $futurePrice->high = $ticker->ticker->high;
            $futurePrice->low = $ticker->ticker->low;
            $futurePrice->volume = $ticker->ticker->vol;
            $futurePrice->contract = $ticker->ticker->contract_id;
            $futurePrice->contract_type = "this_week";
            $futurePrice->unit_amount = $ticker->ticker->unit_amount;
            
        } else if (strtoupper($this->name) == "796") {
            $ticker = json_decode($http->get('http://api.796.com/v3/futures/ticker.html?type=weekly')->body);
            $futurePrice->timestamp = time();
            $futurePrice->last = $ticker->ticker->last;
            $futurePrice->buy = $ticker->ticker->buy;
            $futurePrice->sell = $ticker->ticker->sell;
            $futurePrice->high = $ticker->ticker->high;
            $futurePrice->low = $ticker->ticker->low;
            $futurePrice->volume = $ticker->ticker->vol;
            $futurePrice->contract = '';
            $futurePrice->contract_type = "this_week";
            $futurePrice->unit_amount = 100;
        } else if (strtoupper($this->name) == "BITVC") {
            $ticker = json_decode($http->get('http://market.bitvc.com/futures/ticker_btc_week.js')->body);
            
            $futurePrice->timestamp = time();
            $futurePrice->high = $ticker->high;
            $futurePrice->low = $ticker->low;
            $futurePrice->buy = $ticker->buy;
            $futurePrice->sell = $ticker->sell;
            $futurePrice->last = $ticker->last;
            $futurePrice->volume = $ticker->vol;
            $futurePrice->contract_type = "this_week";
            $futurePrice->contract = $ticker->contract_id;
            $futurePrice->unit_amount = 100;
        }
        
        if($futureTickerTable->save($futurePrice)) {
            error_log("Saved " . $this->name . "'s Future Ticker Prices");
        } else {
            error_log("Failed to save " . $this->name . "'s Future Ticker Prices'");
        }
        
    }
    
    
    public function saveSpotDepthData() {
        $http = new Client();
            
        $spotDepthTable = TableRegistry::get('SpotDepthPrices');
        $spotDepth = $spotDepthTable->newEntity();
        
        
        if(strtoupper($this->name) == "OKCOIN") {
            $depth = json_decode($http->get('https://www.okcoin.com/api/v1/depth.do?symbol=btc_usd')->body);
            $spotDepth->exchange_id = $this->id;
            $spotDepth->timestamp = time();
            $spotDepth->asks = serialize($depth->asks);
            $spotDepth->bids = serialize($depth->bids);
            
        } else if (strtoupper($this->name) == "796") {
            $depth = json_decode($http->get('http://api.796.com/v3/stock/depth.html?type=mri')->body);              
            $spotDepth->exchange_id = $this->id;
            $spotDepth->timestamp = time();
            $spotDepth->asks = serialize($depth->asks);
            $spotDepth->bids = serialize($depth->bids);
            
        } else if (strtoupper($this->name) == "BITVC") {
            // No Bit VC Spot Depth?
        }
        
        if($spotDepthTable->save($spotDepth)) {
            error_log("Saved Spot Depth for " . $this->name);
        } else {
            error_log("Failed to Save Spot Depth for " . $this->name);
        }
    }
    
    public function saveFutureDepthData() {
        $http = new Client();
        
        $futureDepthTable = TableRegistry::get('FutureDepthPrices');
        $futureDepth = $futureDepthTable->newEntity();
        
        if(strtoupper($this->name) == "OKCOIN") {
            $futureDepth->exchange_id = $this->id;
            $futureDepth->timestamp = time();
            $depth = json_decode($http->get('https://www.okcoin.com/api/v1/future_depth.do?symbol=btc_usd&contract_type=this_week')->body);
            $futureDepth->asks = serialize($depth->asks);
            $futureDepth->bids = serialize($depth->bids);
            $futureDepth->contract_type = "this_week";
        } else if (strtoupper($this->name) == "796") {
            $futureDepth->exchange_id = $this->id;
            $futureDepth->timestamp = time();
            $depth = json_decode($http->get('http://api.796.com/v3/futures/depth.html?type=weekly')->body);
            $futureDepth->asks = serialize($depth->asks);
            $futureDepth->bids = serialize($depth->bids);          
            $futureDepth->contract_type = "this_week";
        } else if (strtoupper($this->name) == "BITVC") {
            $futureDepth->exchange_id = $this->id;
            $futureDepth->timestamp = time();
            $depth = json_decode($http->get('http://market.bitvc.com/futures/depths_btc_week.js')->body);
            $futureDepth->asks = serialize($depth->asks);
            $futureDepth->bids = serialize($depth->bids);
            $futureDepth->contract_type = "this_week";
        }
        
        if($futureDepthTable->save($futureDepth)) {
            error_log("Saved Future Depth Data for " . $this->name);
        } else {
            error_log("Failed to save Future Depth Data for " . $this->name);
        }
    }
    
    public function saveSpotTradesData() {
        $http = new Client();
        
        $spotTradesTable = TableRegistry::get('SpotTradePrices');
        
                
        if(strtoupper($this->name) == "OKCOIN") {
            $trades = json_decode($http->get('https://www.okcoin.com/api/v1/trades.do?symbol=btc_usd')->body);
            
            foreach($trades as $trade) {
                $spotTrade = $spotTradesTable->newEntity();
                $spotTrade->exchange_id = $this->id;
                $spotTrade->timestamp = get_object_vars($trade)['date'];
                $spotTrade->price = $trade->price;
                $spotTrade->amount = $trade->amount;
                $spotTrade->tid = $trade->tid;
                $spotTrade->type = $trade->type;
                
                if($spotTradesTable->save($spotTrade)) {
                    error_log("Saved Spot Trade Data for " . $this->name);
                } else {
                    error_log("Failed to Save Spot Trade Data for " . $this->name);
                }
            }
        } else if (strtoupper($this->name) == "796") {
            $trades = json_decode($http->get('http://api.796.com/v3/stock/trades.html?type=mri')->body);              
        
            foreach($trades as $trade) {
                $spotTrade = $spotTradesTable->newEntity();
                $spotTrade->exchange_id = $this->id;
                $spotTrade->timestamp = get_object_vars($trade)['date'];
                $spotTrade->price = $trade->price;
                $spotTrade->amount = $trade->amount;
                $spotTrade->tid = $trade->tid;
                $spotTrade->type = $trade->type;
                
                if($spotTradesTable->save($spotTrade)) {
                    error_log("Saved Spot Trade Data for " . $this->name);
                } else {
                    error_log("Failed to Save Spot Trade Data for " . $this->name);
                }
            }
        
        } else if (strtoupper($this->name) == "BITVC") {
            // BitVC Doesn't Have Spot Trades
        }
    } // end saveSpotTradeData()
    
    public function saveFutureTradesData() {
        $http = new Client();
        
        $spotTradesTable = TableRegistry::get('FutureTradePrices');
        
                
        if(strtoupper($this->name) == "OKCOIN") {
            $trades = json_decode($http->get('https://www.okcoin.com/api/v1/future_trades.do?symbol=btc_usd&contract_type=this_week')->body);
            
            foreach($trades as $trade) {
                $spotTrade = $spotTradesTable->newEntity();
                $spotTrade->exchange_id = $this->id;
                $spotTrade->timestamp = get_object_vars($trade)['date'];
                $spotTrade->price = $trade->price;
                $spotTrade->amount = $trade->amount;
                $spotTrade->tid = $trade->tid;
                $spotTrade->type = $trade->type;
                $spotTrade->contract_type = "this_week";
                
                if($spotTradesTable->save($spotTrade)) {
                    error_log("Saved Future Trade Data for " . $this->name);
                } else {
                    error_log("Failed to Save Future Trade Data for " . $this->name);
                }
            }
        } else if (strtoupper($this->name) == "796") {
            $trades = json_decode($http->get('http://api.796.com/v3/futures/trades.html?type=weekly')->body);              
        
            foreach($trades as $trade) {
                $spotTrade = $spotTradesTable->newEntity();
                $spotTrade->exchange_id = $this->id;
                $spotTrade->timestamp = get_object_vars($trade)['date'];
                $spotTrade->price = $trade->price;
                $spotTrade->amount = $trade->amount;
                $spotTrade->tid = $trade->tid;
                $spotTrade->type = $trade->type;
                $spotTrade->contract_type = "this_week";
                
                if($spotTradesTable->save($spotTrade)) {
                    error_log("Saved Future Trade Data for " . $this->name);
                } else {
                    error_log("Failed to Save Future Trade Data for " . $this->name);
                }
            }
        
        } else if (strtoupper($this->name) == "BITVC") {
            $trades = json_decode($http->get('http://market.bitvc.com/futures/trades_btc_week.js')->body);
            
            foreach($trades as $trade) {
                $spotTrade = $spotTradesTable->newEntity();
                $spotTrade->exchange_id = $this->id;
                $spotTrade->timestamp = get_object_vars($trade)['date'];
                $spotTrade->price = $trade->price;
                $spotTrade->amount = $trade->amount;
                $spotTrade->tid = $trade->tid;
                $spotTrade->type = $trade->type;
                
                if($spotTradesTable->save($spotTrade)) {
                    error_log("Saved Future Trade Data for " . $this->name);
                } else {
                    error_log("Failed to Save Future Trade Data for " . $this->name);
                }
            }
        }
    } // end save Future Data
    
    public function saveSpotCandlestickData() {
    
    }
    
    public function saveFutureCandlestickData() {
    
    }
    
    
    
    ///// OUTDATED METHODS ////////////////////////////////////////////////////////////////////////////
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
