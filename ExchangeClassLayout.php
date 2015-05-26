<?php 
class EXHANGE 
{
    // Abstract Functions 
    public function doGet() {}
    public function doPost() {}
        
    public function buyOrder() {}
    public function sellOrder() {}
    public function cancelOrder() {}
    
    public function getTicker() {}
    public function getDepth() {}
    public function getTrades() {}
    public function getPositions() {}
}
///////////////////////////////////////////////////////////////////////////////
class EXCHANGE_OKCOIN implements EXCHANGE 
{    
    // Spot Price
    public function getSpotTicker() {}
    public function getSpotDepth() {}
    public function getSpotTrades() {}
    public function getSpotKLine() {}
    public function getLendDepth() {}
    
    // Spot Trading
    public function getUserAccountInfo() {}
    public function placeOrder() {}
    public function placeBatchOrder() {}
    public function cancelOrder() {}
    public function getOrderInfo() {}
    public function getOrdersInfo() {}
    public function getOrderHistory() {}
    public function placeWidthdrawal() {}
    public function cancelWidthdrawal() {}
    public function getOrderFee() {}
    public function getUserBorrowInfo() {}
    public function placeBorrowOrder() {}
    public function cancelBorrowOrder() {}
    public function getBorrowOrderInfo() {}
    public function paybackDebt() {}
    public function getDebtList() {}
    public function getAccountRecords() {}
    
    // Futures Price
    public function getFutureTicker() {}
    public function getFutureDepth() {}
    public function getFutureTrades() {}
    public function getFutureIndex() {}
    public function getExchangeRate() {}
    public function getEstimatedDeliveryPrice() {}
    public function getFutureTradeHistory() {}
    public function getFutureKLine() {}
    public function getFutureHoldAmount() {}
    public function getFutureLiquidatyionOrders() {}
    
    // Futures Trading
    public function getFutureUserInfo() {}
    public function getFuturePositions() {}
    public function placeFutureOrder() {}
    public function placeFutureBatchOrder() {}
    public function cancelFutureOrder() {}
    public function getFutureOrderInfo() {}
    public function getFutureOrdersInfo() {}
    public function getFutureUserInfoFixed() {}
    public function getFuturePositionsFixed() {}
}
///////////////////////////////////////////////////////////////////////////////
class EXHANGE_796 implements EXCHANGE 
{
    // Spot Information 
    public function getTicker() {}
    public function getDepth() {}
    public function getTrades() {}
    public function getSettlements() {}
    
    // Weekly Futures Information
    public function getFutureTicker() {}
    public function getFutureDepth() {}
    public function getFutureTrades() {}
    public function getFutureSettlements() {}
        
    // Trade API
    public function getUserInfo() {}
    public function getUserBalance() {}
    public function getUserAssets() {}
    public function deleteAccessToken() {}
    
    public function getFutureOrders() {}
    public function getFutureRecords() {}
    public function getFuturePositions() {}
    public function openBuyOrder() {}
    public function closeBuyOrder() {}
    public function openSellOrder() {}
    public function closeSellOrder() {}
    public function cancelOrder() {}
    public function cancelAllOrders() {}   
}
///////////////////////////////////////////////////////////////////////////////
class EXCHANGE_BITVC implements EXCHANGE 
{
    // Futures Market API
    public function getTicker() {}
    public function getDepth() {}
    public function getTrades() {}
    public function getFutureIndexPrice() {}
    public function getUSDExchangeRate() {}
    
    // Futures Trading API
    public function getBalanceInformation() {}
    public function getDetailedPositionHistory() {}
    public function getSummaryPositionHistory() {}
    public function getAllCurrentOrders() {}
    public function getOrderDetails() {}
    
    public function placeOrder() {}
    public function cancelOrder {}
    public function systemCloseOrder() {}   
}