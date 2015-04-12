<?php

namespace App\View\Cell;

use Cake\View\Cell;

class MenuCell extends Cell
{
    /**
     * Generates a menu bar for a user.
     *
     * @param \App\Model\Entity\User $user
     */
    public function user($user)
    {
        $this->template = 'display';
        $menu = [];
        if ($user)
        {
            $menu[] = [
                'title'   => $user->name,
                'url'     => ['controller' => 'profiles', 'action' => 'show', $user->id],
                'options' => []
            ];
            $menu[] = [
                'title'   => 'Sign Out',
                'url'     => ['controller' => 'users', 'action' => 'logout'],
                'options' => []
            ];
        }
        $this->set('menu', $menu);
    }

    /**
     * Generates a menu bar for a visitor.
     */
    public function visitor()
    {
        $this->template = 'display';
        $menu = [];
        $this->set('menu', $menu);
    }
}