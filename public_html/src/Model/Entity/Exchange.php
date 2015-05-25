<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Exchange Entity.
 */
class Exchange extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'apikey' => true,
        'secretkey' => true,
        'extras' => true,
        'hedge_positions' => true,
    ];
}
