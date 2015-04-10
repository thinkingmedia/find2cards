<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 *
 */
class GamesTable extends Table
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
        $this->table('games');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsToMany('Users', [
            'through' => 'UsersGames'
        ]);
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
                  ->add('match_making', 'valid', ['rule' => 'boolean'])
                  ->requirePresence('match_making', 'create')
                  ->notEmpty('match_making');

        return $validator;
    }

    /**
     * Finds a game that can be joined or creates a new game.
     *
     * @return \App\Model\Entity\Game
     */
    private function find_joinable()
    {
        $game = $this->find()
                     ->where(['match_making' => true])
                     ->first();
        if (!$game)
        {
            $game = $this->newEntity();
            $this->save($game);
        }

        return $game;
    }

    /**
     * Joins a game that is currently in match making mode.
     *
     * @param $user_id
     *
     * @return \App\Model\Entity\Game
     */
    public function join($user_id)
    {
        $game = $this->find_joinable();

        /**
         * @var \App\Model\Table\UsersGamesTable $UsersGames
         */
        $UsersGames = TableRegistry::get('UsersGames');
        $UsersGames->create($user_id, $game->id);
    }

    /**
     * Finds a game that the player is currently playing that isn't finished.
     *
     * @param int $user_id
     *
     * @return \App\Model\Entity\Game
     */
    public function playing($user_id)
    {
        $game = $this->find()
                     ->where([
                                 'finished' => false,
                                 'user_id'  => $user_id
                             ])
                     ->leftJoin('users_games')
                     ->first();
        return $game;
    }
}
