<?php

use Phinx\Migration\AbstractMigration;

class CreateTournament extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('tournaments');
        $table->addColumn('name', 'string');
        $table->addColumn('league_id', 'integer', array('null'=>true, 'default'=>null));
        $table->addColumn('challonge_id', 'string', array('null'=>true, 'default'=>null));
        $table->create();
    }
   
}