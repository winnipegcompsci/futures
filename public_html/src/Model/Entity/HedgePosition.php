<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Network\Http\Client;
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
    protected $_accessible = [
        'exchange_id' => true,
        'bias' => true,
        'amount' => true,
        'ssp' => true,
        'leverage' => true,
        'balance' => true,
        'lastprice' => true,
        'timeopened' => true,
        'recalculation' => true,
        'status' => true,
        'exchange' => true,
    ];
    
    public function getCurrentPrice($exchange) {        
        $http = new Client();
        
        if($exchange == "OKCOIN") {
            $ticker = json_decode($http->get('https://www.okcoin.com/api/v1/ticker.do?symbol=btc_usd')->body);
            return $ticker->ticker->buy;
            
        } else if ($exchange == "796") {
            $ticker = json_decode($http->get('http://api.796.com/v3/futures/ticker.html?type=weekly')->body);
            
            return $ticker->ticker->buy;
            
        } else if ($exchange == "BITVC") {
            return 0;
        }
    }

}
