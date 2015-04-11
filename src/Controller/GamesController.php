<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable      $Games
 * @property \App\Model\Table\UsersGamesTable $UsersGames
 * @property \App\Model\Table\CardsTable      $Cards
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
    }

    /**
     * @param {int} $game_id
     *
     * @return \App\Model\Entity\Game
     */
    private function _mark_game_started($game_id)
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
    private function _mark_player_started($game_id)
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
    public function play($game_id)
    {
        $game = $this->_mark_game_started($game_id);
        $player = $this->_mark_player_started($game_id);
    }
}
