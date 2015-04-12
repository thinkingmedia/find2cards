<?php

namespace App\Controller;

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
    public $use = ['Games', 'UsersGames', 'Cards', 'Lobby' => 'UsersGames'];

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
        $this->set('game_id', $game_id);
    }

    /**
     * @param int|null $game_id
     *
     * @return array|null
     */
    public function update($game_id = null)
    {
        $game = $this->Games->get((int)$game_id);

        $players = $this->Lobby->find()
                               ->contain('Users')
                               ->select(['UsersGames.ready', 'Users.id', 'Users.name', 'Users.image'])
                               ->where(['UsersGames.game_id' => $game_id])
                               ->order(['UsersGames.created' => 'DESC'])
                               ->all();

        return $this->send([
                               'players'  => $players,
                               'finished' => false
                           ]);
    }
}
