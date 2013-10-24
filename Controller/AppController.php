<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

//	public $viewClass = 'Haml';
	public $components = array(
		'DebugKit.Toolbar'=>array(
			'cache'=>array(
				'engine'=>'Apc',
			),
			//'panels'=>array('Redis', 'Tags'), 'forceEnable'=>false
		),
		'Session',
		'Cookie',
		'Users.RememberMe',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					//'fields' => array('username' => 'email', 'password' => 'password'),
					'passwordHasher' => array(
						'className' => 'Blowfish',
					),
				)
			),
			'authorize' => array('Controller'),
			'loginRedirect' => '/',
			'logoutRedirect' => '/',
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->components['Users.RememberMe'] = array('userModel' => 'AppUser');
		$this->helpers[] = 'Gravatar.Gravatar';
		$this->Auth->allow(
				'index', 'display', 'view'
		);

		if (!$this->Auth->loggedIn()) {
			$this->Auth->authError = false;
		}

		$current_user = getCurrentUser();
		$this->set(compact('current_user'));
	}

	public function isAuthorized($user) {
		// Any registered user can access public functions
		if (empty($this->request->params['admin'])) {
			if (empty($this->request->params['prefix'])) {
				return true;
			} elseif ($this->request->params['prefix'] != 'admin') {
				return true;
			}
		}
        //debug($user);exit;
		// Only admins can access admin functions
		if (isset($this->request->params['admin'])) {
			if (!empty($user['is_admin']) && $user['is_admin'] === true) {
				return true;
			}
		}

		// Only admins can access admin functions
		if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
			if (!empty($user['is_admin']) && $user['is_admin'] === true) {
				return true;
			}
		}

		// Default deny
		return false;
	}

}
