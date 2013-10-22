<?php

App::uses('AppController', 'Controller');
App::uses('Challonge', 'Lib');

/**
 * Matches Controller
 *
 */
class MatchesController extends AppController {
       
    public function view($tournament_id, $match_id) {
        $challonge = new Challonge(CHALLONGE_API_KEY);
        $match = $challonge->getMatch($tournament_id, $match_id);
//        var_dump($tournament, $challonge->errors);
        $this->set(compact('match'));
    }
}
