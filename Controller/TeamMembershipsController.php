<?php
App::uses('AppController', 'Controller');
/**
 * TeamMemberships Controller
 *
 * @property TeamMembership $TeamMembership
 */
class TeamMembershipsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TeamMembership->recursive = 0;
		$this->set('teamMemberships', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TeamMembership->exists($id)) {
			throw new NotFoundException(__('Invalid team membership'));
		}
		$options = array('conditions' => array('TeamMembership.' . $this->TeamMembership->primaryKey => $id));
		$this->set('teamMembership', $this->TeamMembership->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TeamMembership->create();
			if ($this->TeamMembership->save($this->request->data)) {
				$this->Session->setFlash(__('The team membership has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team membership could not be saved. Please, try again.'));
			}
		}
		$players = $this->TeamMembership->Player->find('list');
		$teams = $this->TeamMembership->Team->find('list');
		$this->set(compact('players', 'teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TeamMembership->exists($id)) {
			throw new NotFoundException(__('Invalid team membership'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TeamMembership->save($this->request->data)) {
				$this->Session->setFlash(__('The team membership has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team membership could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TeamMembership.' . $this->TeamMembership->primaryKey => $id));
			$this->request->data = $this->TeamMembership->find('first', $options);
		}
		$players = $this->TeamMembership->Player->find('list');
		$teams = $this->TeamMembership->Team->find('list');
		$this->set(compact('players', 'teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TeamMembership->id = $id;
		if (!$this->TeamMembership->exists()) {
			throw new NotFoundException(__('Invalid team membership'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TeamMembership->delete()) {
			$this->Session->setFlash(__('Team membership deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Team membership was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function admin($id = null) {

	}
}
