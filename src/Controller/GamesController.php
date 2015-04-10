<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

/**
 * Games Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\GamesTable $Games
 */
class GamesController extends AppController
{
	public function initialize()
	{
		$this->Users = TableRegistry::get('Users');
		parent::initialize();
	}

	/**
	 * Displays the home page for starting a new game.
	 */
	public function start()
	{
		if (!empty($this->request->data))
		{
			$user = $this->Users->newEntity($this->request->data);
			$user->token = 'test';

			if ($this->Users->save($user))
			{
				$game = $this->Games->newEntity();
				if($this->Games->save($game))
				{
					pr($game);die;
					//$this->redirect('/games/matching');
				}
			}
		}
	}

	/**
	 * Displays the match making page.
	 */
	public function matching()
	{
	}

	/**
	 * Displays the game page.
	 */
	public function play()
	{
	}

	/**
	 * Shows the results for a finished game.
	 */
	public function stats()
	{
	}
}
