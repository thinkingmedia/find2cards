<?php

namespace App\Controller;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable      $Games
 * @property \App\Model\Table\UsersGamesTable $UsersGames
 * @property \App\Model\Table\UsersGamesTable $Lobby
 */
class GamesController extends AppController
{
    public $use = ['Games', 'UsersGames', 'Lobby' => 'UsersGames'];

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
        }

        return $player;
    }

    private static function fisherYatesShuffle(&$items, $seed)
    {
        @mt_srand($seed);
        for ($i = count($items) - 1; $i > 0; $i--)
        {
            $j = @mt_rand(0, $i);
            $tmp = $items[$i];
            $items[$i] = $items[$j];
            $items[$j] = $tmp;
        }
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

        $data = array_merge(range(1, 12), range(1, 12));
        self::fisherYatesShuffle($data, $game->created->getTimestamp());

        $cards = [];
        for ($i = 0; $i < 24; $i++)
        {
            $cards['card-'.$i] = [
                'id'=>$i,
                'type'=>$data[$i]
            ];
        }

        $this->set('cards', $cards);
        $this->set('game_id', (int)$game_id);
    }

    /**
     * @param int|null $game_id
     * @param int|null $score
     * @param int|null $matches
     *
     * @return array|null
     */
    public function update($game_id = null, $score = null, $matches = null)
    {
        $game = $this->Games->get((int)$game_id);
        $player = $this->UsersGames->get([$this->user_id, $game_id]);

        $player->score = $score;
        $player->matches = $matches;
        $this->Lobby->save($player);

        $players = $this->Lobby->find()
                               ->contain('Users')
                               ->select(['UsersGames.ready', 'UsersGames.score', 'UsersGames.matches', 'Users.id', 'Users.name', 'Users.image'])
                               ->where(['UsersGames.game_id' => $game_id])
                               ->order(['UsersGames.created' => 'DESC'])
                               ->all();

        return $this->send([
                               'players'  => $players,
                               'finished' => false
                           ]);
    }
}
