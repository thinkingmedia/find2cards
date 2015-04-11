<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * @method User get($primaryKey, $options = [])
 * @method User newEntity($data = null, array $options = [])
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     *
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsToMany('Games', [
            'through' => 'UsersGames'
        ]);
    }

    /**
     * @param string               $provider Provider name.
     * @param \Hybrid_User_Profile $profile  The Profile
     *
     * @return boolean
     */
    public function registration($provider, $profile)
    {
        $user = $this->newEntity([
                                     'name'         => $profile->displayName,
                                     'image'        => $profile->photoURL,
                                     'provider_uid' => $profile->identifier,
                                     'provider'     => $provider
                                 ]);
        if (!$this->save($user))
        {
            Log::write(LOG_ERR, 'Failed to create new user record');
        }

        return true;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     *
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->add('id', 'valid', ['rule' => 'numeric'])
                  ->allowEmpty('id', 'create')
                  ->requirePresence('name', 'create')
                  ->notEmpty('name');

        return $validator;
    }
}
