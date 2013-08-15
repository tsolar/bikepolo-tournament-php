<?php
App::uses('AppModel', 'Model');
/**
 * SocialAccount Model
 *
 * @property User $User
 */
class SocialAccount extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'provider';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
