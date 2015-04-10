<?php
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * @property \Cake\Controller\Component\FlashComponent $Flash
 * @property \Cake\Controller\Component\AuthComponent  $Auth
 */
class AppController extends Controller
{

	/**
	 * Configure components.
	 */
	public function initialize()
	{
		$this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'loginRedirect'  => [
				'controller' => 'games',
				'action'     => 'start',
				'plugin'     => false
			],
			'loginAction'    => [
				'controller' => 'users',
				'action'     => 'login',
				'plugin'     => false
			],
			'logoutRedirect' => [
				'controller' => 'users',
				'action'     => 'login',
				'plugin'     => false
			],
			'authenticate'   => [
				'ADmad/HybridAuth.HybridAuth' => [
					'registrationCallback' => 'registration' // method on UsersTable.php
				]
			]
		]);
	}
}
