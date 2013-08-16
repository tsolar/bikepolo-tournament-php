<?php

use Phinx\Migration\AbstractMigration;

class CreateTeamsAndPlayers extends AbstractMigration
{
    public function change()
    {
		$teams_table = $this->table('teams');
		$teams_table->addColumn('name', 'string');
		$teams_table->addColumn('since_date', 'date', array('null'=>true, 'default'=>null));
		$teams_table->addColumn('active', 'boolean', array('default'=>1));
		$teams_table->addColumn('logo', 'string', array('null'=>true, 'default'=>null));
		$teams_table->addColumn('created', 'datetime');
		$teams_table->addColumn('modified', 'datetime');
		$teams_table->create();

		$players_table = $this->table('players');
		$players_table->addColumn('user_id', 'integer', array('null'=>true, 'default'=>null));
		$players_table->addColumn('name', 'string');
		$players_table->addColumn('since_date', 'date', array('null'=>true, 'default'=>null));
		$players_table->addColumn('active', 'boolean', array('default'=>1));
		$players_table->addColumn('photo', 'string', array('null'=>true, 'default'=>null));
		$players_table->addColumn('created', 'datetime');
		$players_table->addColumn('modified', 'datetime');
		$players_table->create();

		$membership_table = $this->table('players_teams');
		$membership_table->addColumn('player_id', 'integer');
		$membership_table->addColumn('team_id', 'integer');
		$membership_table->addColumn('approved', 'boolean', array('default'=>0));
		$membership_table->addColumn('is_captain', 'boolean', array('default'=>0));
		$membership_table->addColumn('is_admin', 'boolean', array('default'=>0));
		$membership_table->addColumn('join_date', 'date');
		$membership_table->addColumn('created', 'datetime');
		$membership_table->addColumn('modified', 'datetime');
		$membership_table->create();
    }
}