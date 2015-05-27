<?php
require_once (dirname(__FILE__) . '/Base.php');

class OKCoin extends OKCoinBase {

	//Constructor
	function __construct($authentication) {
		parent::__construct($authentication);
	}

    // Spot Price API    
	public function tickerApi($params = null) {
		return $this->get("/api/v1/ticker.do", $params);
	}
	
	public function depthApi($params = null) {
		return $this->get("/api/v1/depth.do", $params);
	}

	public function tradesApi($params = null) {
		return $this->get("/api/v1/trades.do", $params);
	}

	public function klineDataApi($params = null) {
		return $this->get("/api/v1/kline.do", $params);
	}
	
    public function lendDepthApi($params = null) {
        return $this->get("/api/v1/lend_depth.do");
    }
    
    
    // Spot Trading API
	public function userinfoApi($params = null) {
		return $this->post("/api/v1/userinfo.do", $params);
	}

	public function tradeApi($params = null) {
		return $this->post("/api/v1/trade.do", $params);
	}

	public function batchTradeApi($params = null) {
		return $this->post("/api/v1/batch_trade.do", $params);
	}

	public function cancelOrderApi($params = null) {
		return $this->post("/api/v1/cancel_order.do", $params);
	}
	
	public function orderInfoApi($params = null) {
		return $this->post("/api/v1/order_info.do", $params);
	}

	public function ordersInfoApi($params = null) {
		return $this->post("/api/v1/orders_info.do", $params);
	}

	public function orderHistoryApi($params = null) {
		return $this->post("/api/v1/order_history.do", $params);
	}
    
	public function withdrawApi($params = null) {
		return $this->post("/api/v1/withdraw.do", $params);
	}
	
	public function cancelWithdrawApi($params = null) {
		return $this->post("/api/v1/cancel_withdraw.do", $params);
	}

    public function orderFeeApi($params = null) {
        return $this->post("/api/v1/order_fee.do", $params);
    }
    
    public function borrowsInfoApi($params = null) {
        return $this->post("/api/v1/borrows_info.do", $params);
    }
    
    public function borrowMoneyApi($params = null) {
        return $this->post("/api/v1/borrow_money.do", $params);
    }
    
    public function cancelBorrowApi($params = null) {
        return $this->post("/api/v1/cancel_borrow.do", $params);
    }
    
    public function borrowOrderInfoApi($params = null) {
        return $this->post("/api/v1/borrow_order_info.do", $params);
    }
    
    public function payBackDebtApi($params = null) {
        return $this->post("/api/v1/repayment.do", $params);
    }
    
    public function getDebtListApi($params = null) {
        return $this->post("/api/v1/unrepayments_info.do", $params);
    }
    
    public function getAccountRecordApi($params = null) {
        return $this->post("/api/v1/account_records.do", $params);
    }
    
    // Future Price API
	public function tickerFutureApi($params = null) {

		return $this->get("/api/v1/future_ticker.do", $params);
	}

	public function depthFutureApi($params = null) {
		return $this->get("/api/v1/future_depth.do", $params);
	}

	public function tradesFutureApi($params = null) {
		return $this->get("/api/v1/future_trades.do", $params);
	}

	public function getUSD2CNYRateFutureApi($params = null) {
		return $this->get("/api/v1/exchange_rate.do", $params);
	}

	public function getEstimatedPriceFutureApi($params = null) {
	    return $this->get("/api/v1/future_estimated_price.do", $params);
	}

	public function futureTradesHistoryFutureApi($params = null) {
		return $this->get("/api/v1/future_trades_history.do", $params);
	}
    
    public function getFutureCandlestick($params = null) {
        return $this->get("/api/v1/future_kline.do", $params);
    }
    
    public function getFutureHoldAmount($params = null) {
        return $this->get("/api/v1/future_hold_amount.do", $params);
    }
    
    public function getForcedLiquidationOrders($params = null) {
        return $this->get("/api/v1/future_explosive.do", $params);
    }

	public function getFutureIndexFutureApi($params = null) {
		return $this->get("/api/v1/future_index.do", $params);
	}
	
    // Future Trading API
	public function userinfoFutureApi($params = null) {
		return $this->post("/api/v1/future_userinfo.do", $params);
	}

	public function positionFutureApi($params = null) {
		return $this->post("/api/v1/future_position.do", $params);
	}

	public function tradeFutureApi($params = null) {
		return $this->post("/api/v1/future_trade.do", $params);
	}

	public function batchTradeFutureApi($params = null) {
		return $this->post("/api/v1/future_batch_trade.do", $params);
	}

	public function getOrderFutureApi($params = null) {
		return $this->post("/api/v1/future_order_info.do", $params);
	}

	public function cancelFutureApi($params = null) {
		return $this->post("/api/v1/future_cancel.do", $params);
	}

	public function fixUserinfoFutureApi($params = null) {
		return $this->post("/api/v1/future_userinfo_4fix.do", $params);
	}

	public function singleBondPositionFutureApi($params = null) {
		return $this->post("/api/v1/future_position_4fix.do", $params);
	}
}
