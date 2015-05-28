<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SpotTradePrice Entity.
 */
class SpotTradePrice extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'exchange_id' => true,
        'timestamp' => true,
        'price' => true,
        'amount' => true,
        'tid' => true,
        'type' => true,
        'exchange' => true,
    ];
}
