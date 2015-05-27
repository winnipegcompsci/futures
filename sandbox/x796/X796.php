<?php
require_once (dirname(__FILE__) . '/Base.php');

class X796 extends X796Base {

	//Constructor
	function __construct($authentication) {
		parent::__construct($authentication);
	}

    // Spot Market API 
    public function getTicker($params = null) {
        return $this->get("http://api.796.com/v3/stock/ticker.html", $params);
    }
    
    public function getDepth($params = null) {
        return $this->get("http://api.796.com/v3/stock/depth.html", $params);
    }
    
    public function getTrades($params = null) {
        return $this->get("http://api.796.com/v3/stock/trades.html", $params);
    }
    
    public function getSettlements($params = null) {
        return $this->get("http://api.796.com/v3/stock/settle.html", $params);
    }
    
    // Futures Market API
    public function getFutureTicker($params = null) {
        return $this->get("http://api.796.com/v3/futures/ticker.html", $params);
    }
    
    public function getFutureDepth($params = null) {
        return $this->get("http://api.796.com/v3/futures/depth.html", $params);
    }
    
    public function getFutureTrades($params = null) {
        return $this->get("http://api.796.com/v3/futures/trades.html", $params);
    }
    
    public function getFutureSettlements($params = null) {
        return $this->get("http://api.796.com/v3/futures/settle.html", $params);
    }
    
    // Trade API
    public function getUserInfo($params = null) {
        return $this->post("https://796.com/v2/user/get_info", $params);
    }
    
    public function getUserBalance($params = null) {
        return $this->post("https://796.com/v2/user/get_balance", $params);
    }
    
    public function getUserAssets($params = null) {
        return $this->post("https://796.com/v2/user/get_assets", $params);
    }
    
    public function getBTCFutureOrders($params = null) {
        return $this->post("https://796.com/v2/weeklyfutures/orders", $params);
    }
    
    public function getBTCFutureRecords($params = null) {
        return $this->post("https://796.com/v2/weeklyfutures/records", $params);
    }
    
    public function getBTCFuturePositions($params = null) {
        return $this->post("https://796.com/v2/weeklyfutures/position", $params);
    }
    
    public function openBTCFutureBuy($params = null) {
        return $this->post("https://796.com/v2/weeklyfutures/open_buy", $params);
    }
    
    public function closeBTCFutureBuy($params = null) {
        return $this->post("https://796.com/v2/weeklyfutures/close_buy", $params);
    }
    
    public function openBTCFutureSell($params = null) {
        return $this->post("https://796.com/v2/weeklyfutures/open_sell", $params);
    }
    
    public function closeBTCFutureSell($params = null) {
        return $this->post("https://796.com/v2/weeklyfutures/close_sell", $params);
    }
    
    public function cancelBTCFutureOrder($params = null) {
        return $this->post("https://796.com/v2/weeklyfutures/cancel_order", $params);
    }
    
    public function cancelAllBTCFutureOrders($params = null) {
        return $this->post("https://796.com/v2/weeklyfutures/cancel_all", $params);
    }
}
