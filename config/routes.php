<?php

use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('InflectedRoute');

Router::connect('/', ['controller' => 'home', 'action' => 'index']);

Router::connect('/users/login/:type', [
    'controller' => 'users',
    'action'     => 'login'
], ['pass' => ['type']]);

Router::connect('/:controller', ['action' => 'index']);
Router::connect('/:controller/:action/:id', [], ['id' => '\d+', 'pass' => ['id']]);
Router::connect('/:controller/:action', []);

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
