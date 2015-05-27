<?php 
require 'okcoin/OKCoin.php';

class Exchange 
{    
    function __construct($exchange_name) {
        $this->name = $exchange_name;         
    }
        
    public function getName() {
        return $this->name;
    }   
    
        
    public function getAPIKey() {
        return $this->keys['API_KEY'];
    }
    
    public function getSecretKey() {
        return $this->keys['SECRET_KEY'];
    }
    
    
    
    public function setName($name) {
        $this->name = $name;
    }
        
    public function setAPIKey($newkey) {
        $this->keys['API_KEY'] = $newkey;
    }
     
    public function setSecretKey($newkey) {
        $this->keys['SECRET_KEY'] = $newkey;
    }
    
    // Abstract Functions         
    public function buyOrder() {
        echo "This function has not been implemented yet!<br />";
    }
    
    public function sellOrder() {
        echo "This function has not been implemented yet!<br />";
    }
    
    public function getOrderDetails() {
        echo "This function has not been implemented yet!<br />";
    }
    
    public function cancelOrder() {
        echo "This function has not been implemented yet!<br />";
    }
    
    public function getTicker() {
        echo "This function has not been implemented yet!<br />";
    }
    
    public function getDepth() {
        echo "This function has not been implemented yet!<br />";
    }
    
    public function getTrades() {
        echo "This function has not been implemented yet!<br />";
    }
    
    public function getPositions() {
        echo "This function has not been implemented yet!<br />";
    }
}

///////////////////////////////////////////////////////////////////////////////
class OKCoinWrapper extends Exchange
{       
    function __construct($apikey, $secretkey) {
        $this->client = new OKCoin(
            new OKCoin_ApiKeyAuthentication($apikey, $secretkey)
        );
    }
    
    // Get Future Ticker
    public function getTicker($symbol = 'btc') {
        $params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
        
        if($symbol == 'ltc') {
            $params['symbol'] = 'ltc_usd';
        }
        
        return json_encode($this->client->tickerFutureApi($params));
    }
    
    // Get Future Depth    
    public function getDepth() {
        $params = array(
            'symbol' => 'btc_usd',
            'contract_type' => 'this_week',
        );
        
        return json_encode($this->client->depthFutureApi($params));
    }
    
    
    public function getTrades() {
        $params = array(
            'symbol' => 'btc_usd',
            'contract_type' => 'this_week',
            'size' => '100',
        );
        
        return json_encode($this->client->tradesFutureApi($params));
    }
    
    public function getUserInfo() {
        $params = array(
            'api_key' => $this->apikey
        );
        
        return json_encode($this->client->userinfoFutureApi($params));
    }
    
    public function getFuturePositions() {
        $params = array(
            
        );
        
        return json_encode($this->client->positionFutureApi($params));
    }
    
    public function placeTrade() {
        $params = array(
            
        );
        
        
    }
    
    public function placeBatchTrade() {
        $params = array(
        
        );
    }
    
    public function cancelOrder() {
        $params = array(
        
        );
    }
    
    public function getOrderInfo() {
        $params = array(
        
        );
    }
    
    public function getOrdersInfo() {
        $params = array(
        
        );
    }
    
    public function getUserInfoFixed() {
        $params = array(
        
        );
    }
    
    public function getUserPositionsFixed() {
        $params = array(
        
        );
    }
}

///////////////////////////////////////////////////////////////////////////////
class X796Wrapper extends Exchange 
{
    function __construct($apikey, $secretkey, $appid = "null") {
        $this->keys = array(
            'API_KEY' => $apikey,
            'SECRET_KEY' => $secretkey,
            'APP_ID' => $appid,
        );
    }
    
    public function send($url, $parameters = array()) {
        foreach($parameters as $key => $param) {
            $params[$key] = $param;
        }
        
        $data = $params;
        
        ksort($params);
        
        $param_uri = http_build_query($params,'','&');
        $sig = base64_encode(hash_hmac('sha1', $param_uri, $this->keys['SECRET_KEY']));
        $token_url = $url . '?' . $param_uri . 
            "&appid=" . $this->keys['APP_ID'] . 
            "&timestamp=" . time() . 
            "&apikey=" . $this->keys['API_KEY'] . 
            "&sig=" . $sig;
                
        $curl = curl_init($token_url);

        
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if(!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        $result = curl_exec($curl);
        curl_close($curl);
        
        return $result;
    }
       
    // Future Price Functions
    public function getTicker() {
        $ticker = $this->send('http://api.796.com/v3/futures/ticker.html', array('type' => 'weekly'));
        
        return $ticker;
    }
    
    public function getDepth() {
        $depth = $this->send('http://api.796.com/v3/futures/depth.html', array('type' => 'weekly'));
        
        return $depth;
    }
    
    public function getTrades() {
        $trades = $this->send('http://api.796.com/v3/futures/trades.html', array('type' => 'weekly'));
        
        return $trades;
    }
    
    public function getSettlements() {
        $settlements = $this->send('http://api.796.com/v3/futures/trades.html', array('type' => 'weekly'));
        
        return $settlements;
    }   
    
    // User Functions 
    public function get_user_info() {
        
    }
    
    public function get_user_balance() {
    
    }
    
    public function get_user_assets() {
    
    }
    
    public function get_btc_future_orders() {
    
    }
    
    public function get_btc_future_record() {
    
    }
    
    public function get_btc_future_positions() {
    
    }
    
    public function open_buy_btc_future_order() {
    
    }
    
    public function close_buy_btc_future_order() {
    
    }
    
    public function open_sell_btc_future_order() {
    
    }
    
    public function close_sell_btc_future_order() {
    
    }
    
    public function cancel_order() {
    
    }
    
    public function cancel_all() {
    
    }
    
}

///////////////////////////////////////////////////////////////////////////////
class BitVCWrapper extends Exchange 
{

}