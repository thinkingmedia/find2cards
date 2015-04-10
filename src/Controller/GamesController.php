<?php
namespace App\Controller;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable $Games
 */
class GamesController extends AppController
{
    /**
     * Displays the home page for starting a new game.
     */
    public function start()
    {
    }

    /**
     * Displays the match making page.
     */
    public function join()
    {
        $user_id = (int)$this->Auth->user('id');
        $game = $this->Games->playing($user_id);

        // go to game already in progress
        if($game && !$game->match_making)
        {
            $this->redirect(['action'=>'play',$game->id]);
        }

        // join a new game
        if(!$game)
        {
            $game = $this->Games->join((int)$this->Auth->user('id'));
        }
    }

    /**
     * Displays the game page.
     *
     * @param int $id
     */
    public function play($id)
    {
    }

    /**
     * Shows the results for a finished game.
     */
    public function stats()
    {
    }
}
