<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SpotDepthPrice Entity.
 */
class SpotDepthPrice extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'exchange_id' => true,
        'timestamp' => true,
        'asks' => true,
        'bids' => true,
        'exchange' => true,
    ];
}
