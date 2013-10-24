<?php

use Phinx\Migration\AbstractMigration;

class CreateTournamentParticipant extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('tournament_participants');
        $table->addColumn('tournament_id', 'integer');
        $table->addColumn('team_id', 'integer');
        $table->addColumn('challonge_id', 'string', array('null'=>true, 'default'=>null));
        $table->create();
    }
    
}