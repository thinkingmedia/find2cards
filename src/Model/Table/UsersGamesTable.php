<?php
namespace App\Model\Table;

use App\Model\Entity\UsersGame;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersGames Model
 *
 * @method UsersGame get($primaryKey, $options = [])
 * @method UsersGame newEntity($data = null, array $options = [])
 */
class UsersGamesTable extends Table
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
        $this->table('users_games');
        $this->displayField('user_id');
        $this->primaryKey(['user_id', 'game_id']);
        $this->addBehavior('Timestamp');

        $this->belongsTo('Users');
        $this->belongsTo('Games');
    }

    /**
     * Assigns a user to a game.
     *
     * @param int $user_id
     * @param int $game_id
     */
    public function create($user_id, $game_id)
    {
        $record = $this->newEntity([
                                       'user_id' => $user_id,
                                       'game_id' => $game_id
                                   ]);
        $this->save($record);
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
                  ->allowEmpty('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     *
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['game_id'], 'Games'));

        return $rules;
    }
}
