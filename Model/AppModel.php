<?php

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 */
App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	function getCurrentUser($field = null) {
		App::uses('CakeSession', 'Model/Datasource');
		$Session = new CakeSession();
		$user = $Session->read('Auth.User');
		App::uses('User', 'Model');
		$User = new User();
		$u = $User->findById($user['id']);
		return $u;
	}

}
