<?php

App::uses('AppController', 'Controller');

class TestController extends AppController {

    public function index() {
//        $numplayers = 11;
//        if ($numplayers % 2 != 0)
//            $numplayers++; // Dummy
//
//        for ($round = 0; $round < $numplayers - 1; $round++) {
//            echo 'Squad ' . ($round + 1) . ":\n\n<br>1-";
//
//            for ($i = 0; $i < $numplayers - 1; $i++) {
//                if ($i % 2 == 0) {
//                    $player = ($numplayers - 2) - ($i / 2) - $round;
//                } else {
//                    $player = ((($i - 1) / 2) - $round);
//                }
//                if ($player < 0)
//                    $player += $numplayers - 1;
//                echo ($player + 2);
//                echo ($i % 2 == 0) ? "\n<br>" : '-';
//            }
//            echo "\n\n<br>";
//        }
//        exit;

        $players = range(1, 6);
        $count = count($players);

        // Order players.
        for ($i = 0; $i < log($count / 2, 2); $i++) {
            $out = array();

            foreach ($players as $player) {
                $splice = pow(2, $i);

                $out = array_merge($out, array_splice($players, 0, $splice));

                $out = array_merge($out, array_splice($players, -$splice));
            }

            $players = $out;
        }

        // Print match list.
        for ($i = 0; $i < $count; $i++) {
            printf('%s vs %s<br />%s', $players[$i], $players[++$i], PHP_EOL);
        }
        exit;
    }

    
}
