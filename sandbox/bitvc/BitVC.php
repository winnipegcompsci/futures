<?php
require_once (dirname(__FILE__) . '/Base.php');

class BitVC extends BitVCBase {

	//Constructor
	function __construct($authentication) {
		parent::__construct($authentication);
	}

    // BitVC Trade API
    public function getAssetInformation($params = null) {
        return $this->post("https://api.bitvc.com/api/accountInfo/get", $params);
    }
    
    public function getProceedingOrders($params = null) {
        return $this->post("https://api.bitvc.com/api/order/list", $params);
    }
    
    public function getOrderDetails($params = null) {
        return $this->post("https://api.bitvc.com/api/order/{id}", $params);
    }
    
    public function orderBuyMarket($params = null) {
        return $this->post("https://api.bitvc.com/api/order/buy_market", $params);
    }

    public function orderBuy($params = null) {
        return $this->post("https://api.bitvc.com/api/order/buy", $params);
    }
    
    public function orderSellMarket($params = null) {
        return $this->post("https://api.bitvc.com/api/order/sell_market", $params);
    }
    
    public function orderSell($params = null) {
        return $this->post("https://api.bitvc.com/api/order/sell", $params);
    }
    
    public function orderCancel($params = null) {
        return $this->post("https://api.bitvc.com/api/order/cancel/{id}", $params);
    }
    
    // BitVC Future Market API
    public function getFutureTicker($params = null) {
        return $this->post("http://market.bitvc.com/futures/ticker_btc_week.js", $params);
    }
    
    public function getFutureDepth($params = null) {
        return $this->post("http://market.bitvc.com/futures/depths_btc_week.js", $params);
    }
    
    public function getFutureTrades($params = null) {
        return $this->post("http://market.bitvc.com/futures/trades_btc_week.js", $params);
    }
    
    public function getFutureIndexPrice($params = null) {
        return $this->post("https://www.bitvc.com/futures_market/index_price_btc", $params);
    }
    
    public function getUSDExchangeRate($params = null) {
        return $this->post("http://market.bitvc.com/futures/exchange_rate.js", $params);
    }    
    
    // BitVC Future Trade API
    public function getFutureBalance($params = null) {
        return $this->post("https://api.bitvc.com/futures/balance", $params);
    }
    
    public function getFuturePositionsHistory($params = null) {
        return $this->post("https://api.bitvc.com/futures/holdOrder/list", $params);
    }
    
    public function getFuturePositionsHistorySummary($params = null) {
        return $this->post("https://api.bitvc.com/futures/holdOrder", $params);
    }
    
    public function getCurrentFutureOrders($params = null) {
        return $this->post("https://api.bitvc.com/futures/order/list", $params);
    }
    
    public function getFutureOrderDetails($params = null) {
        return $this->post("https://api.bitvc.com/futures/order", $params);
    }
    
    public function placeFutureOrder($params = null) {
        return $this->post("https://api.bitvc.com/futures/order/save", $params);
    }
    
    public function cancelFutureOrder($params = null) {
        return $this->post("https://api.bitvc.com/futures/order/cancel", $params);
    }
    
    public function systemCloseOrder($params = null) {
        return $this->post("https://api.bitvc.com/futures/systemCloseOrder/list", $params);
    }
}
