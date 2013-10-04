<?php

App::uses('AppHelper', 'View/Helper');

/**
 * Description of PlayersHelper
 *
 * @author tom
 */
class PlayersHelper extends AppHelper {

	public $helpers = array('Html', 'Gravatar.Gravatar');

	public function getPhoto($player_id) {
		$Player = ClassRegistry::init('Player');
		$player = $Player->findById($player_id);
		if (!empty($player)) {
			if (!empty($player['Player']['photo'])) {
				return $this->Html->image($player['Player']['photo']);
			} elseif(!empty($player['User']['email'])) {
				return $this->Gravatar->image($player['User']['email']);
			} else {
				return $this->Html->image('holder.js/80x80/auto/text:Sin foto');
			}
		}
	}

}
