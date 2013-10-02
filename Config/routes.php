<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));


Router::connect(
		'/opauth-complete/*', array('controller' => 'app_users', 'action' => 'opauth_complete')
);
/**
 * users plugin
 */
Router::connect('/users', array('plugin' => null, 'controller' => 'app_users'));
Router::connect('/users/index/*', array('plugin' => null, 'controller' => 'app_users'));
//admin
//Router::connect('/admin/users/*', array('plugin' => null, 'controller' => 'app_users', 'action' => 'index', 'prefix' => 'admin'));
//Router::connect('/admin/users/users/:action/*', array('plugin' => null, 'controller' => 'app_users', 'prefix' => 'admin'));
//Router::connect('/admin/users/:action/*', array('plugin' => null, 'controller' => 'app_users', 'prefix' => 'admin'));

Router::connect('/users/users/:action/*', array('plugin' => null, 'controller' => 'app_users'));
Router::connect('/users/:action/*', array('plugin' => null, 'controller' => 'app_users'));
Router::connect('/admin/users/login', array('plugin' => null, 'controller' => 'app_users', 'action' => 'login'));
Router::connect('/login/*', array('plugin' => null, 'controller' => 'app_users', 'action' => 'login'));
Router::connect('/logout/*', array('plugin' => null, 'controller' => 'app_users', 'action' => 'logout'));
Router::connect('/register/*', array('plugin' => null, 'controller' => 'app_users', 'action' => 'add'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
