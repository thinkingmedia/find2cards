<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Game Entity.
 *
 * @property boolean $match_making
 * @property boolean $finished
 */
class Game extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'match_making' => true,
        'finished'      => true
    ];
}
