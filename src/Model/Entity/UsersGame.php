<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersGame Entity.
 *
 * @property int     $user_id
 * @property int     $game_id
 * @property boolean $ready
 * @property boolean $started
 * @property int     $score
 * @property int     $matches
 */
class UsersGame extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'game_id' => true,
        'ready'   => true,
        'started' => true,
        'score'   => true,
        'matches' => true,
        'user'    => true,
        'game'    => true,
    ];
}
