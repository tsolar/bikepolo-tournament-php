<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 */
class UsersController extends AppController {

	//public $scaffold = 'admin';
	
	public function beforeFilter() {
		$this->Auth->allow('login', 'logout', 'opauth_complete');
		parent::beforeFilter();
	}

	public function opauth_complete() {
		$this->autoLayout = false;
		$this->autoRender = false;

		$user = $this->User->findById($this->Auth->user('id'));
		$profile = array();
		$user_data = array();
		$profile['user_id'] = null;
		if(!empty($this->data)) {
			if(!empty($this->data['auth']['info'])) {
				$auth_info = $this->data['auth']['info'];
				$profile['first_name'] = $auth_info['first_name'];
				$profile['last_name'] = $auth_info['last_name'];
				$profile['location'] = $auth_info['location'];
				$profile['image'] = $auth_info['image'];
			}
			if(!empty($this->data['auth']['raw'])) {
				$raw = $this->data['auth']['raw'];
				$profile['gender'] = $raw['gender'];
				$profile['timezone'] = $raw['timezone'];
				$profile['locale'] = $raw['locale'];
				$user_data['username'] = $raw['username'];
			}
		}

		// verifico que si no hay usuario con el id, no haya con el username
		if(empty($user)) {
			$user = $this->User->findByUsername($user_data['username']);
		}

		if(!empty($user)) {
			$data = $user;
			$profile['user_id'] = $user['User']['id'];
			$data['Profile'] = $profile; // cambiar por foreach
			$data['Profile']['id'] = $user['Profile']['id'];
		} else {
			$data = $user;
			$data['User'] = array();
			$data['User']['username'] = $user_data['username'];
			$data['Profile'] = $profile; 
			
		}
		if ($this->User->saveAssociated($data)) {
			$this->Session->setFlash(__('Account associated!'));
			$this->Auth->login($data['User']);
			return $this->redirect(Router::url('/users/profile'));
		}
		else {
			$this->Session->setFlash(__("Can't associate account :("));
		}
		return $this->redirect(Router::url('/users/login'));
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

	public function profile() {
		
	}
}
