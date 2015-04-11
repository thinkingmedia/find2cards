<?php
namespace App\Model\Entity;

/**
 * Game Entity.
 *
 * @property boolean   $match_making
 * @property boolean   $finished
 * @property \DateTime $starts
 * @property int       $players
 */
class Game extends AppEntity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'match_making' => true,
        'finished'     => true,
        'starts'       => true,
        'players'      => true
    ];
}
