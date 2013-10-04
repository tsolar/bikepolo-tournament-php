<?php
App::uses('AppModel', 'Model');
/**
 * Team Model
 *
 * @property TeamMembership $TeamMembership
 */
class Team extends AppModel {
/**
 * Order field
 * @var string
 */
	public $order = 'name';
	
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'since_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
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
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TeamMembership' => array(
			'className' => 'TeamMembership',
			'foreignKey' => 'team_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function afterSave($created) {
		if($created) {
			$this->TeamMembership->create();
			$user = $this->getCurrentUser();
			if(!empty($user['Player'])) {
				$data = array(
					'player_id'=>$user['Player']['id'],
					'team_id'=>$this->id,
					'approved'=>1,
					'is_admin'=>1,
					'is_captain'=>1,
					'join_date'=>date('Y-m-d')
				);
				$this->TeamMembership->save($data);
			}
		}
		return parent::afterSave($created);
	}
}