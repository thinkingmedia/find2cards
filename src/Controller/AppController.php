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
     * @var array Magic loading models.
     */
    public $use = [];

    /**
     * @var int|null The current user.
     */
    protected $user_id = null;

    /**
     * @var \App\Model\Entity\User|null The current user
     */
    protected $user;

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

    /**
     * @param Event $event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->user = $this->Auth->user();
        if ($this->user)
        {
            $this->user_id = (int)$this->Auth->user('id');

            $this->set('user', $this->user);
            $this->set('user_id', $this->user);
        }
    }

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
     * Will send data as JSON or a request response. The data must be key/value pairs.
     *
     * @param array $data
     *
     * @return array|null
     */
    protected function send(array $data)
    {
        if ($this->request->is('requested'))
        {
            return $data;
        }

        $this->RequestHandler->respondAs('json');
        $this->viewClass = 'Json';
        foreach ($data as $key => $value)
        {
            $this->set($key, $value);
        }
        $this->set('_serialize', array_keys($data));

        return null;
    }
}
