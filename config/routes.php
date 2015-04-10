<?php

use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('InflectedRoute');

Router::connect('/', ['controller' => 'users', 'action' => 'login']);
Router::connect('/:controller/:action', []);

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
