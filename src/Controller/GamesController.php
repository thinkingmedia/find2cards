<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable      $Games
 * @property \App\Model\Table\UsersGamesTable $UsersGames
 * @property \App\Model\Table\CardsTable      $Cards
 * @property \App\Model\Table\UsersGamesTable $Lobby
 */
class GamesController extends AppController
{
    /**
     * @param Event $event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->UsersGames = $this->loadModel('UsersGames');
        $this->Cards = $this->loadModel('Cards');
        $this->Lobby = $this->loadModel('UsersGames');
    }

    /**
     * @param {int} $game_id
     *
     * @return \App\Model\Entity\Game
     */
    private function _mark_game_started($game_id = null)
    {
        $game = $this->Games->get($game_id);
        if ($game->match_making)
        {
            $game->match_making = false;
            $this->Games->save($game);
        }

        return $game;
    }

    /**
     * @param {int} $game_id
     *
     * @return \App\Model\Entity\UsersGame
     */
    private function _mark_player_started($game_id = null)
    {
        $player = $this->UsersGames->get([$this->user_id, $game_id]);
        if (!$player->started)
        {
            $player->started = true;
            $this->UsersGames->save($player);
            $this->Cards->create($this->user_id, $game_id, 6 * 4);
        }

        return $player;
    }

    /**
     * Displays the match making page.
     *
     * @param int $game_id
     */
    public function play($game_id = null)
    {
        $game = $this->_mark_game_started($game_id);
        $player = $this->_mark_player_started($game_id);

        $cards = $this->Cards->query()
                             ->where(['user_id' => $this->user_id, 'game_id' => $game_id])
                             ->order(['`order`'])
                             ->all();

        $this->set('cards', $cards);
        $this->set('user_id', $this->user_id);
        $this->set('game_id', $game_id);
    }

    /**
     * @param int $game_id
     */
    public function update($game_id = null)
    {
        $this->RequestHandler->respondAs('json');
        $this->viewClass = 'Json';
        $game = $this->Games->get((int)$game_id);

        $players = $this->Lobby->find()
                               ->contain('Users')
                               ->select(['UsersGames.ready', 'Users.id', 'Users.name', 'Users.image'])
                               ->where(['UsersGames.game_id' => $game_id])
                               ->order(['UsersGames.created' => 'DESC'])
                               ->all();

        $this->set('players', $players);
        $this->set('finished', false);
        $this->set('_serialize', ["players","finished"]);
    }
}
