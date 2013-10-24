<?php

use Phinx\Migration\AbstractMigration;

class CreateMatch extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('matches');
        $table->addColumn('tournament_id', 'integer');
        $table->addColumn('team1_id', 'integer');
        $table->addColumn('team2_id', 'integer');
        $table->addColumn('winner', 'integer');
        $table->addColumn('loser', 'integer');
        $table->addColumn('tie', 'boolean', array('default'=>0));
        $table->addColumn('team1_score', 'integer');
        $table->addColumn('team2_score', 'integer');
        $table->addColumn('challonge_id', 'string', array('null'=>true, 'default'=>null));
        $table->create();
    }
}