<?php

namespace App\Controller;

use Cake\Network\Exception\BadRequestException;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable $Games
 */
class GamesController extends AppController
{
    /**
     * Displays the match making page.
     *
     * @param int $game_id
     */
    public function play($game_id)
    {
        $game = $this->Games->get($game_id);
        if($game->match_making)
        {
            $game->match_making = false;
            $this->Games->save($game);
        }
    }
}
