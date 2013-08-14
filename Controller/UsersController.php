<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 */
class UsersController extends AppController {

	//public $scaffold = 'admin';
	
	public function opauth_complete() {
		debug($this->data);
	}

	// This allows me to fetch the user row however I want and set a cookie too
	public function login() {
		// 2.0 Auth login
		if ($this->request->is('post')) {
			// Try to login
			$user = $this->User->login(
					$this->request->data['User']['username'],
					AuthComponent::password($this->request->data['User']['password'])
			);

			if (!empty($user)) {
				$this->Auth->login($user['User']);

				// Update last login
				$this->User->id = $user['User']['id'];
				$this->User->saveField('last_login', date('Y-m-d H:i:s'));
				$this->Session->setFlash(__('You have successfully logged in.'));

				if (!empty($this->request->data['User']['remember'])) {
					$this->Cookie->write('User',
							array_intersect_key(
									$user['User'], array('username' => null, 'password' => null)
							), true, '1 year');
				}
				elseif ($this->Cookie->read('User') != null) {
					// Delete cookie if they didnt tick a box
					$this->Cookie->delete('User');
				}

				return $this->redirect($this->Auth->redirect());
			}
			else {
				$this->Auth->loginError = __('Login error');
				$this->Session->setFlash($this->Auth->loginError, 'default',
						array('class'=>'alert alert-error'), 'auth');
			}
		}

		if ($this->Auth->user()) {
			$this->Session->setFlash(__('You are already registered and logged in!'));
			$this->redirect($this->Auth->redirect());
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
