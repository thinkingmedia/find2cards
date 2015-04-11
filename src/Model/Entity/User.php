<?php
namespace App\Model\Entity;

/**
 * User Entity.
 *
 * @property string $name
 * @property string $image
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
        'image'        => true,
        'provider'     => true,
        'provider_uid' => true,
    ];
}
