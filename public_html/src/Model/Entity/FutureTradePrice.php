<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FutureTradePrice Entity.
 */
class FutureTradePrice extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'exchange_id' => true,
        'timestamp' => true,
        'amount' => true,
        'price' => true,
        'tid' => true,
        'type' => true,
        'contract_type' => true,
        'exchange' => true,
    ];
}
