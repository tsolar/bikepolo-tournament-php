<?php

App::uses('ChallongeAPI', 'Vendor/challonge-php');
require_once APP.'Vendor/challonge-php/challonge.class.php';

/**
 * Description of Challonge
 *
 * @author tom
 */
class Challonge extends ChallongeAPI {
    function test() {
        echo 'CHALLONGE RULES!';
    }

}
