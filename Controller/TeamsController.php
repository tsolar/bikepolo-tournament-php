<?php
App::uses('AppController', 'Controller');
/**
 * Teams Controller
 *
 * @property Team $Team
 */
class TeamsController extends AppController {

	public $uses = array('Team', 'TeamMembership', 'Player');
	public $layout = 'bpt';

	public function beforeFilter() {
		if(!empty($this->params['pass'][0])) {
			$team_id = $this->params['pass'][0];
		}
		$basic_url = str_replace('/admin', '', $this->here);

		if(strpos($this->action,'admin_') !== false) {
			if(!$this->Player->isAdmin($team_id)) {
				return $this->redirect(Router::url($basic_url, true));
			}
		}
		parent::beforeFilter();
	}

	private function checkAdmin() {
		$team_id = null;
		if(!empty($this->params['pass'][0])) {
			$team_id = $this->params['pass'][0];
		}
		if(!$this->Player->isAdmin($team_id)) {
			return $this->redirect(Router::url('index', true));
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
		$this->Team->recursive = 2;
		$team = $this->Team->find('first', $options);
		$this->set('team', $team);
		$this->set('is_admin', $this->Player->isAdmin($id));

		$user = getCurrentUser();
		$player_id = $user['Player']['id'];
		foreach($team['TeamMembership'] as $m) {
			if($player_id == $m['player_id']) {
				$has_membership = true;
				break;
			}
		}
		$this->set(compact('has_membership'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Team->create();
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->checkAdmin();
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
			$this->request->data = $this->Team->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->checkAdmin();
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Team->delete()) {
			$this->Session->setFlash(__('Team deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Team was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function admin($id = null) {
		$this->checkAdmin();
	}

	public function memberships($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		$this->set('memberships', $this->Team->TeamMembership->findAllByTeamId($id));
	}

	public function sendInvitations() {
		$this->checkAdmin();
		$this->autoRender = false;
		$this->autoLayout = false;

		$players = $this->request->data('players');
		$team_id = $this->request->data('team_id');
		if(!empty($players)) {
			foreach($players as $p) {
				if($p) {
					$this->saveTeamMembership($team_id, $p);
				}
			}
		}
	}

	public function requestInvitation() {
		$this->autoRender = false;
		$this->autoLayout = false;

		$user = getCurrentUser();
		$player_id = $user['Player']['id'];
		$team_id = $this->request->data('team_id');
		$this->saveTeamMembership($team_id, $player_id);
	}

	public function getPlayersNotInTeam() {
		$this->autoLayout = false;
		$user = getCurrentUser();
		$player_id = $user['Player']['id'];
		//debug($this->request->data);
		$team_id = $this->request->data('team_id');
		$players = $this->Player->TeamMembership->find('all', array(
			'conditions'=>array(
				'NOT'=>array('TeamMembership.team_id'=>array( $team_id )), // not in team
				'NOT'=>array('Player.id'=>array( $player_id )), // not current user
				),
			'group'=>'Player.id'
		));
		//debug($players);
		$this->set(compact('players'));
	}

	private function saveTeamMembership($team_id, $player_id) {
		$membership = $this->Team->TeamMembership->findByTeamIdAndPlayerId($team_id, $player_id);
		if(!empty($membership)) {
			$this->Team->TeamMembership->create();
			$this->Team->TeamMembership->save(
						array(
							'player_id'=>$player_id,
							'team_id'=>$team_id
						)
					);
		}
	}

	public function player($id) {
		$this->paginate = array(
			'TeamMembership' => array(
				'conditions' => array(
					'player_id =' => $id,
					'approved' => 1,
					'Team.id !='=>'null'
				),
				'limit' => 10,
			),
		);
		$this->set('teams', $this->paginate('TeamMembership'));
	}
}
