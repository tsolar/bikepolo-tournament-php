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

	public $viewClass = 'Haml';
	
	public $components = array(
		'DebugKit.Toolbar',//=>array('panels'=>array('Redis', 'Tags'), 'forceEnable'=>false),
		'Session',
		'Cookie',
		'Auth' => array(
			'authenticate'=>array(
				'Form'=> array(
					'fields'=>array('username'=>'email', 'password'=>'password'),
					'passwordHasher' => array(
						'className' => 'Blowfish',
					),
				)
			),
			'loginRedirect' => '/',
			'logoutRedirect' =>'/',
		)
	);

	public function beforeFilter() {
		$this->Auth->allow(
				'index',
				'display',
				'view'
				);
		if (Configure::read('debug') > 0) {
			$this->scaffold = '';
		}
		$current_user = getCurrentUser();
		$this->set(compact('current_user'));

		// This allows me to log the user in with the cookie
		$userData = $this->Cookie->read('User');
		if (!empty($userData)) {
			// Loader User model
			$this->loadModel($this->Auth->authenticate['Form']['userModel']);

			$userData = $this->User->login(
					$userData['username'], $userData['password']
			);

			// Log them in and refresh page
			if (!empty($userData) && $this->Auth->login($userData['User'])) {
				$this->redirect($this->request->here);
			}

		}
		parent::beforeFilter();
	}
}
