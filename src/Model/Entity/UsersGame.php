<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersGame Entity.
 *
 * @property int $user_id
 * @property int $game_id
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
        'user' => true,
        'game' => true,
    ];
}
