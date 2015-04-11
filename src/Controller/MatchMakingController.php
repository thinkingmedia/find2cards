<?php

namespace App\Controller;

use Cake\Network\Exception\BadRequestException;
use Cake\ORM\TableRegistry;

/**
 * @property \App\Model\Table\GamesTable $Games
 */
class MatchMakingController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Games = TableRegistry::get('Games');
    }

    /**
     * This will find a new game for the player and redirect them
     * to the lobby.
     */
    public function join()
    {
        $game = $this->Games->playing($this->user_id);
        if (!$game)
        {
            $this->Games->join($this->user_id);
        }
        $this->redirect(['action' => 'lobby']);
    }

    /**
     * This displays the match making screen for a game. The user waits
     * here while other players join the game.
     */
    public function lobby()
    {
        $game = $this->Games->playing($this->user_id);
        if(!$game)
        {
            throw new BadRequestException('Player is not part of any game.');
        }

        if (!$game->match_making)
        {
            $this->redirect(['controller' => 'games', 'action' => 'play']);
        }
    }
}