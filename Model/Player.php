<?php
App::uses('AppModel', 'Model');
/**
 * Player Model
 *
 * @property User $User
 * @property Team $Team
 */
class Player extends AppModel {

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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TeamMembership' => array(
			'className' => 'TeamMembership',
			'foreignKey' => 'player_id',
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

	public function findWithoutCurrentUser($type = 'first', $params = array()) {
		return $this->findWithoutMe($type, $params);
	}

	public function findWithoutMe($type = 'first', $params = array()) {
		$user = $this->getCurrentUser();
		debug($user);
		$user_id = $user['id'];
		$params['conditions']['user_id !='] = $user_id;
		return $this->find($type, $params);
	}

	public function isAdmin($team_id) {
		$id = $this->getIdFromUser();
		App::uses('TeamMembership', 'Model');

		$team_membership = $this->TeamMembership->findByTeamIdAndPlayerId($team_id, $id);
		if(!empty($team_membership)) {
			return $team_membership['TeamMembership']['is_admin'];
		}
		return false;
	}

	/**
	 * Returns player id if given user has player. Otherwise returns null.
	 * 
	 * @param integer $id user id
	 * @return integer player id
	 */
	public function getIdFromUser($id = null) {
		if(is_null($id)) {
			$user = getCurrentUser();
		} else {
			$user = $this->User->findById($id);
		}

		$player_id = null;
		if(!empty($user['Player'])) {
			$player_id = $user['Player']['id'];
		}
		return $player_id;
	}
}
