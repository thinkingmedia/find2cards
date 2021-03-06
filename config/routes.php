<?php

use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('InflectedRoute');

Router::connect('/', ['controller' => 'home', 'action' => 'index']);

Router::connect('/users/login/:type', [
    'controller' => 'users',
    'action'     => 'login'
], ['pass' => ['type']]);

Router::connect('/profiles/:id', [
    'controller' => 'profiles',
    'action'     => 'show'
], ['id' => '\d+', 'pass' => ['id']]);

Router::connect('/games/update/:id/:score/:matches', [
    'controller' => 'games',
    'action'     => 'update'
], [
                    'id'    => '\d+',
                    'score' => '\d+',
                    'matches' => '\d+',
                    'pass'  => ['id', 'score', 'matches']
                ]);

Router::connect('/:controller', ['action' => 'index']);
Router::connect('/:controller/:action/:id', [], ['id' => '\d+', 'pass' => ['id']]);
Router::connect('/:controller/:action', []);

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
