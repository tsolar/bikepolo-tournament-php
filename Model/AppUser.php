<?php

App::uses('User', 'Users.Model');

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

}
