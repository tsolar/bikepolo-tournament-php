<?php

App::uses('User', 'Users.Model');

/**
 * @property Player $Player
 * @property Profile $Profile
 * @property SocialAccount $SocialAccount
 * @property UserDetail $UserDetails
 */
class AppUser extends User {

	public $useTable = 'users';

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
		),
		'Player' => array(
			'className' => 'Player',
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
		),
		'UserDetail' => array(
			'className' => 'Users.UserDetail',
			'foreignKey' => 'user_id'
		),
	);

	public function afterSave($created, $options = array()) {
		if ($created) {
			if (empty($this->data['Player'])) {
				$this->data['Player']['since_date'] = date('Y-m-d');
				$this->data['Player']['active'] = true;
				$this->data['Player']['name'] = $this->data['AppUser']['username'] ? $this->data['AppUser']['username'] : 'NN';
				$this->data['Player']['user_id'] = $this->data['AppUser']['id'];
				$player = $this->Player->save($this->data['Player']);
				if (!empty($player)) {
					//return true;
				}
			}
		}
		parent::afterSave($created, $options);
	}

	public function beforeSave($options = array()) {
		parent::beforeSave($options);
	}

}
