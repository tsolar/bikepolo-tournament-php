<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Profile $Profile
 */
class User extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'username';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Profile' => array(
			'className' => 'Profile',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'SocialAccount' => array(
			'className' => 'SocialAccount',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

	// Checks a login and returns a user
	public function login($usernameOrEmail, $password) {
        return $this->find('first', array(
					'conditions' => array(
						'OR' => array(
							'User.email' => $usernameOrEmail,
							'User.username' => $usernameOrEmail
						),
						'User.password' => $password
					),
					'recursive' => -1
		));
	}
}
