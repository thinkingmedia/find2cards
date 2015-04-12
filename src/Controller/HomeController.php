<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * Handles the home page.
 */
class HomeController extends AppController
{
    /**
     * Allow all
     *
     * @param Event $event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }

    /**
     * If user is not logged in the home page is shown. Prompting them to login via social networks.
     */
    public function index()
    {
        if (!empty($this->user))
        {
            $this->redirect(['controller' => 'profiles','action'=>'show',$this->user_id]);
        }
    }
}