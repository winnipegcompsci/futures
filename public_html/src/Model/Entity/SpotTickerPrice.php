<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SpotTickerPrice Entity.
 */
class SpotTickerPrice extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'exchange_id' => true,
        'timestamp' => true,
        'buy' => true,
        'high' => true,
        'last' => true,
        'low' => true,
        'sell' => true,
        'vol' => true,
        'exchange' => true,
    ];
}
