<?php

namespace App\Controller;

/**
 * Handles the viewing and browsing of user profiles.
 *
 * @property \App\Model\Table\UsersTable $Users;
 */
class ProfilesController extends AppController
{
    /**
     * @var array Models
     */
    public $use = ['Users'];

    /**
     * Redirects to the user's own profile.
     */
    public function go()
    {
        $this->redirect(['action'=>'show',$this->user_id]);
    }

    /**
     * @param int $user_id
     */
    public function show($user_id = null)
    {
        $this->set('user',$this->Users->get($user_id));
    }
}