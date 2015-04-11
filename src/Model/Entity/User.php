<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 *
 * @property string $name
 * @property string $provider
 * @property string $provider_uid
 */
class User extends AppEntity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name'         => true,
        'provider'     => true,
        'provider_uid' => true,
    ];
}
