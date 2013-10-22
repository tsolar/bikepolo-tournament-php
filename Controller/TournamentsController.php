<?php

App::uses('AppController', 'Controller');
App::uses('Challonge', 'Lib');

/**
 * Tournaments Controller
 *
 */
class TournamentsController extends AppController {
    public function index() {
        // show all tournaments from Challonge
        $challonge = new Challonge(CHALLONGE_API_KEY);
        $tournaments = $challonge->getTournaments(array('state'=>'all', 'subdomain'=>'chilebikepolo'));
        $this->set(compact('tournaments'));
    }
    
    public function view($id) {
        $challonge = new Challonge(CHALLONGE_API_KEY);
        $tournament = $challonge->getTournament($id);
//        var_dump($tournament, $challonge->errors);
        $this->set(compact('tournament'));
        
        $matches = $challonge->getMatches($id);
        $this->set(compact('matches'));
    }
}
