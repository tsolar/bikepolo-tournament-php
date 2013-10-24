<?php

App::uses('AppController', 'Controller');
App::uses('Challonge', 'Lib');

/**
 * Tournaments Controller
 *
 * @property Tournament $Tournament
 * @property PaginatorComponent $Paginator
 */
class TournamentsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
		$this->Tournament->recursive = 0;
		$this->set('tournaments', $this->Paginator->paginate());
        // show all tournaments from Challonge
//        $challonge = new Challonge(CHALLONGE_API_KEY);
//        $tournaments = $challonge->getTournaments(array('state' => 'all', 'subdomain' => 'chilebikepolo'));
//        $this->set(compact('tournaments'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}
		$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
        $tournament = $this->Tournament->find('first', $options);
        $challonge_tournament_id = $tournament['Tournament']['challonge_id'];
        $challonge = new Challonge(CHALLONGE_API_KEY);
        $challonge_tournament = $challonge->getTournament($challonge_tournament_id);
        //var_dump($tournament, $challonge->errors);exit;
        $this->set(compact('challonge_tournament', 'tournament'));

        $matches = $challonge->getMatches($id);
        $this->set(compact('matches'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Tournament->recursive = 0;
        $this->set('tournaments', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Tournament->exists()) {
            throw new NotFoundException(__('Invalid tournament'));
        }
//        $options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
        $options = array('conditions' => array('Tournament.challonge_id' => $id));
        $this->set('tournament', $this->Tournament->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Tournament->create();
            // crear en Challonge
            $tournament_name = $this->request->data('Tournament.name');
            $tournament_type = $this->request->data('Tournament.type');
            $challonge = new Challonge(CHALLONGE_API_KEY);
            $params = array( 
//                'organization_id'=>'17186',
                'tournament[name]' => $tournament_name,
                'tournament[url]' => $tournament_name,
                'tournament[tournament_type]' => $tournament_type,
                //optional
                'tournament[subdomain]'=>'chilebikepolo',
//                'description'=>'asdasd',
//                'open_signup'=>false,
//                'hold_third_place_match'=>false,
//                'show_rounds'=>false,
//                'private'=>false,
//                'sequential_pairings'=>false,
            );
            $tournament = $challonge->createTournament($params);
//            var_dump($this->request->data,$params,$tournament,$challonge, $tournament->id.'<---- ID');echo '1';exit;
            if (empty($challonge->errors)) {
                $challonge_id = $tournament->id;
                $data = $this->request->data;
                $data['Tournament']['challonge_id'] = $challonge_id;
                if ($this->Tournament->save($data)) {

                    $this->Session->setFlash(__('The tournament has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The tournament could not be saved. Please, try again.'));
                }
            } else {
                echo 'errors:<br>';
                var_dump($challonge->errors);
                exit;
            }
        }
        $leagues = $this->Tournament->League->find('list');
        $this->set(compact('leagues'));

        $types = array(
            'single elimination' => __('Single elimination'),
            'double elimination' => __('Double elimination'),
            'round robin' => __('Round robin'),
            'swiss' => __('Swiss'),
        );
        $this->set(compact('types'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Tournament->exists($id)) {
            throw new NotFoundException(__('Invalid tournament'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Tournament->save($this->request->data)) {
                $this->Session->setFlash(__('The tournament has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tournament could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
            $this->request->data = $this->Tournament->find('first', $options);
        }
        $leagues = $this->Tournament->League->find('list');
        $this->set(compact('leagues'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Tournament->id = $id;
        if (!$this->Tournament->exists()) {
            throw new NotFoundException(__('Invalid tournament'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Tournament->delete()) {
            $this->Session->setFlash(__('The tournament has been deleted.'));
        } else {
            $this->Session->setFlash(__('The tournament could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
