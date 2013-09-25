<?php

App::uses('UsersController', 'Users.Controller');

class AppUsersController extends UsersController {

	public $name = 'AppUsers';

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout', 'opauth_complete');
		$this->components['Users.RememberMe'] = array('userModel' => 'AppUser');
		$this->RememberMe->restoreLoginFromCookie();
		$this->User = ClassRegistry::init('AppUser');
		$this->set('model', 'AppUser');
	}

	protected function _setupAuth() {
		parent::_setupAuth();

		$this->Auth->loginRedirect = '/'; //array('plugin' => null, 'admin' => false, 'controller' => 'app_users', 'action' => 'login');
	}

	public function render($view = null, $layout = null) {
		if (is_null($view)) {
			$view = $this->action;
		}
		$viewPath = substr(get_class($this), 0, strlen(get_class($this)) - 10);
		if (!file_exists(APP . 'View' . DS . $viewPath . DS . $view . '.ctp')) {
			$this->plugin = 'Users';
		} else {
			$this->viewPath = $viewPath;
		}
		return parent::render($view, $layout);
	}

	public function login() {
		if (empty($this->request->data)) {
			if ($this->Auth->User() !== null) {
				return $this->redirect($this->referer());
			}
		}
		parent::login();
	}

	public function opauth_complete() {
		$this->autoLayout = false;
		$this->autoRender = false;
		//var_dump($this->Auth->user('id'));
		$user = $this->User->findById($this->Auth->user('id'));
		$profile = array();
		$user_data = array(
			'username' => null
		);
		$profile['user_id'] = null;
		$provider = null;
		$uid = null;
		$provider_data = array();
		$provider_data['user_id'] = null;
		if (!empty($this->data)) {
			if (!empty($this->data['auth']['provider'])) {
				$provider = $this->data['auth']['provider'];
			}
			if (!empty($this->data['auth']['uid'])) {
				$uid = $this->data['auth']['uid'];
			}
			if (!empty($this->data['auth']['info'])) {
				$auth_info = $this->data['auth']['info'];
				$profile['first_name'] = $auth_info['first_name'];
				$profile['last_name'] = $auth_info['last_name'];
				$profile['location'] = $auth_info['location'];
				$profile['image'] = $auth_info['image'];
			}
			if (!empty($this->data['auth']['raw'])) {
				$raw = $this->data['auth']['raw'];
				//var_dump($raw);
				$profile['gender'] = $raw['gender'];
				$profile['timezone'] = $raw['timezone'];
				$profile['locale'] = $raw['locale'];
				$user_data['username'] = $raw['username'];
				$user_data['email'] = $raw['email'];
			}
		}

		// verifico que si no hay usuario con el id, no haya con el username
		if (!empty($user_data) && $user_data['username']) {
			if (empty($user)) {
				$user = $this->User->findByUsername($user_data['username']);
			}
		}

		$provider_data['provider'] = $provider;
		$provider_data['uid'] = $uid;
		$provider_data['data'] = json_encode($this->data);

		$social_account = $this->User->SocialAccount->find('first', array(
			'conditions' => array(
				'uid' => $uid,
				'provider' => $provider
			)
				)
		);

		if (!empty($user)) {
			$data = $user;
			$profile['user_id'] = $user['AppUser']['id'];

			if (empty($data['AppUser']['email'])) {
				$data['AppUser']['email'] = $user_data['email'];
				$data['AppUser']['email_verified'] = 1;
			}

			$data['Profile'] = $profile; // cambiar por foreach
			$data['Profile']['id'] = $user['Profile']['id'];
			if (empty($social_account)) {
				$provider_data['user_id'] = $user['AppUser']['id'];
				$data['SocialAccount'] = array($provider_data);
			} else {
				// hay usuario y hay social account

				// si el usuario no coincide, la social account ya está en uso
				if($user['AppUser']['id'] != $social_account['User']['id']) {
					$this->Session->setFlash(__("Account already used!"));
					return $this->redirect(Router::url('/users/login'));
				}
			}
		} else {
			// no hay usuario, lo creamos
			$data = $user;
			$data['AppUser'] = array();
			$data['AppUser']['username'] = $user_data['username'];
			$data['AppUser']['email'] = $user_data['email'];
			$data['Profile'] = $profile;

			if (!empty($social_account)) {
				// hay una social account, pero no hay usuario!
				$data['SocialAccount'] = $social_account;
			} else {
				$data['SocialAccount'] = array($provider_data);
			}
		
		}
		// automated data
		$data['AppUser']['tos'] = true;
		$data['AppUser']['active'] = true;
		if(empty($data['AppUser']['password'])) {
			$data['AppUser']['password'] = AuthComponent::password(rand(1000000, 99999999));
		}

		// Player
		if(empty($data['Player']['name'])) {
			$data['Player']['name'] =
					$user_data['username'] ? $user_data['username'] : 'NN';
		}
		if(empty($data['Player']['since_date'])) {
			$data['Player']['since_date'] = date('Y-m-d');
		}
		if(empty($data['Player']['active'])) {
			$data['Player']['active'] = true;
		}
//		var_dump($data);
//		exit;
		if ($this->User->saveAssociated($data)) {
			$this->Session->setFlash(__('Login successful!'));
			$this->Auth->login($data['AppUser']);
			return $this->redirect(Router::url('/users/profile'));
		} else {
			var_dump($this->User->validationErrors);
			exit;
			$this->Session->setFlash(__("Can't associate account :("));
		}
		return $this->redirect(Router::url('/users/login'));
	}

	public function profile() {
		$current_user = getCurrentUser();
		$this->User->id = $current_user['AppUser']['id'];
		$user = $this->User->findById($current_user['AppUser']['id']);
		$teams = $this->User->Player->TeamMembership->find('all', array(
			'conditions' => array(
				'TeamMembership.player_id =' => $user['Player']['id'],
			),
		));
		$this->set(compact('user', 'teams'));
	}

}