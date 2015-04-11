<?php

namespace App\Controller;

/**
 * @property \App\Model\Table\GamesTable      $Games
 * @property \App\Model\Table\UsersTable      $Users
 * @property \App\Model\Table\UsersGamesTable $Lobby
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
        $this->Lobby = $this->loadModel('UsersGames');
        $this->Users = $this->loadModel('Users');
    }

    /**
     * Find a new game for the player and redirect them
     * to the lobby.
     */
    public function join()
    {
        $game = $this->Games->join($this->user_id);
        $this->redirect(['action' => 'show', $game->id]);
    }

    /**
     * Displays the match making screen for a game. The user waits
     * here while other players join the game.
     *
     * @param int|null $game_id
     */
    public function show($game_id = null)
    {
        $game = $this->Games->get((int)$game_id);
        if (!$game->match_making)
        {
            $this->redirect(['controller' => 'games', 'action' => 'play']);
        }
        $this->set('game', $game);
    }

    /**
     * User has left the lobby.
     *
     * @param int|null $game_id
     */
    public function leave($game_id = null)
    {
        $game = $this->Games->get((int)$game_id);
        $record = $this->Lobby->get([$this->user_id, $game->id]);
        $this->Lobby->delete($record);

        $this->Flash->info('You are no longer waiting to play.');
        $this->redirect(['controller' => 'home', 'action' => 'session']);
    }

    /**
     * User toggles their ready state.
     *
     * @param int|null $game_id
     */
    public function ready($game_id = null)
    {
        $this->RequestHandler->respondAs('json');
        $this->viewClass = 'Json';
        $game = $this->Games->get((int)$game_id);

        $player = $this->Lobby->get([$this->user_id, $game->id]);
        $player->ready = true;

        $this->Lobby->save($player);

        $this->set('game_id', $game->id);
        $this->set('_serialize', ['game_id']);
    }

    /**
     * Get a list of players and their ready status.
     *
     * @param int|null $game_id
     */
    public function update($game_id = null)
    {
        $this->RequestHandler->respondAs('json');
        $this->viewClass = 'Json';
        $game = $this->Games->get((int)$game_id);

        $players = $this->Lobby->find()
                               ->contain('Users')
                               ->select(['UsersGames.ready', 'Users.id', 'Users.name', 'Users.image'])
                               ->where(['UsersGames.game_id' => $game->id])
                               ->all();

        $this->set('players', $players);
        $this->set('_serialize', ["players"]);
    }
}