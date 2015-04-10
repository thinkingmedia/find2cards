<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Allow logins
     *
     * @param Event $event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login']);
    }

    /**
     * @param null $type
     *
     * @return \Cake\Network\Response|null
     */
    public function login($type = null)
    {
        $providers = Configure::read('HybridAuth.providers');
        if (!isset($providers[$type]))
        {
            throw new NotFoundException();
        }

        $this->request->data = [
            'provider'    => $type,
            'openid_identifier' => 'http://memory.thinkingmedia.local'
        ];

        $user = $this->Auth->identify();
        if (!$user)
        {
            $this->Flash->error(__('We could not authenticate with the other party.'));

            return null;
        }

        $this->Auth->setUser($user);

        return $this->redirect($this->Auth->redirectUrl());
    }

    /**
     * End the user's session.
     *
     * @return \Cake\Network\Response|void
     */
    public function logout()
    {
        $this->Flash->error(__('You have signed out.'));

        return $this->redirect($this->Auth->logout());
    }
}
