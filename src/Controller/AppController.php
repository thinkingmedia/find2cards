<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * @property \Cake\Controller\Component\FlashComponent          $Flash
 * @property \Cake\Controller\Component\AuthComponent           $Auth
 * @property \Cake\Controller\Component\RequestHandlerComponent $RequestHandler
 */
class AppController extends Controller
{
    /**
     * @var int The current user.
     */
    protected $user_id;

    /**
     * @var array Magic loading models.
     */
    public $use = [];

    /**
     * Configure components.
     */
    public function initialize()
    {
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Auth', [
            'loginRedirect'  => [
                'controller' => 'profiles',
                'action'     => 'go',
                'plugin'     => false
            ],
            'loginAction'    => [
                'controller' => 'home',
                'action'     => 'index',
                'plugin'     => false
            ],
            'logoutRedirect' => [
                'controller' => 'home',
                'action'     => 'index',
                'plugin'     => false
            ],
            'authenticate'   => [
                'ADmad/HybridAuth.HybridAuth' => [
                    'registrationCallback' => 'registration' // method on UsersTable.php
                ]
            ]
        ]);
    }

    /**
     * @param Event $event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->user_id = (int)$this->Auth->user('id');
    }

    /**
     * Handles magic loading of models.
     *
     * @param string $name
     *
     * @return bool|object
     */
    public function __get($name)
    {
        if (in_array($name, $this->use))
        {
            return $this->loadModel($name);
        }
        if (isset($this->use[$name]))
        {
            return $this->loadModel($this->use[$name]);
        }

        return parent::__get($name);
    }
}
