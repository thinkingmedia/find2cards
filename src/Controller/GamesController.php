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
     */
    public function play()
    {
        $game = $this->Games->playing($this->user_id);
        if(!$game)
        {
            throw new BadRequestException('Player is not part of any game.');
        }
    }
}
