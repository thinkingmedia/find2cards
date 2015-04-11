<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cards Model
 */
class CardsTable extends Table
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
        $this->table('cards');
        $this->displayField('user_id');
        $this->primaryKey(['user_id', 'game_id']);
        $this->belongsTo('Users');
        $this->belongsTo('Games');
    }

    /**
     * @param {int} $user_id
     * @param {int} $game_id
     * @param {int} $count
     */
    public function create($user_id, $game_id, $count)
    {
        $query = $this->query()
                      ->insert(['`user_id`', '`game_id`', '`order`']);

        for ($i = 0; $i < $count; $i++)
        {
            $query->values([
                               '`user_id`' => $user_id,
                               '`game_id`' => $game_id,
                               '`order`'   => $i
                           ]);
        }

        $query->execute();
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
        $validator->add('order', 'valid', ['rule' => 'numeric'])
                  ->requirePresence('order', 'create')
                  ->notEmpty('order')
                  ->requirePresence('type', 'create')
                  ->notEmpty('type');

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
