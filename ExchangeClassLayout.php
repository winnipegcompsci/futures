<?php 
class Exchange 
{
    $name = "";         // Name of Exchange
    $keys = array(
        'API_KEY' => '',
        'SECRET_KEY' => '',
        
    );    // API Key, Secret Key, 
    
    
    
    
    // Abstract Functions         
    public function buyOrder() {}
    public function sellOrder() {}
    public function getOrderDetails() {}
    public function cancelOrder() {}
    
    public function getTicker() {}
    public function getDepth() {}
    public function getTrades() {}
    public function getPositions() {}
}

///////////////////////////////////////////////////////////////////////////////
class Exchange_OKCOIN extends Exchange
{
    
}

///////////////////////////////////////////////////////////////////////////////
class Exchange_796 extends Exchange 
{
    
}

///////////////////////////////////////////////////////////////////////////////
class Exchange_BITVC implements EXCHANGE 
{

}