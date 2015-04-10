<?php

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	/**
	 * @return \Cake\Network\Response|null
	 */
	public function login()
	{
		if (!$this->request->is('post'))
		{
			return null;
		}

		$user = $this->Auth->identify();
		if (!$user)
		{
			$this->Flash->error(__('Invalid username or password, try again'));
			return null;
		}

		$this->Auth->setUser($user);
		return $this->redirect($this->Auth->redirectUrl());
	}

	public function logout()
	{
		$this->Flash->error(__('You have signed out.'));
		return $this->redirect($this->Auth->logout());
	}
}
