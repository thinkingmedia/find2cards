<?php

namespace App\Controller;

use Cake\Network\Exception\NotFoundException;

/**
 * @property \App\Model\Table\GamesTable $Games
 */
class LobbiesController extends AppController
{
    /**
     * Loads the games table.
     */
    public function initialize()
    {
        parent::initialize();

        $this->Games = $this->loadModel('Games');
    }

    /**
     * This will find a new game for the player and redirect them
     * to the lobby.
     */
    public function join()
    {
        $game = $this->Games->join($this->user_id);
        $this->redirect(['action' => 'show', $game->id]);
    }

    /**
     * This displays the match making screen for a game. The user waits
     * here while other players join the game.
     *
     * @param int $game_id
     */
    public function show($game_id = null)
    {
        $game = $this->Games->get((int)$game_id);
        if (!$game->match_making)
        {
            $this->redirect(['controller' => 'games', 'action' => 'play']);
        }
    }
}