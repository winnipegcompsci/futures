<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FutureTickerPrice Entity.
 */
class FutureTickerPrice extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'exchange_id' => true,
        'timestamp' => true,
        'last' => true,
        'buy' => true,
        'sell' => true,
        'high' => true,
        'low' => true,
        'volume' => true,
        'contract' => true,
        'contract_type' => true,
        'unit_amount' => true,
        'exchange' => true,
        'contract' => true,
    ];
}
