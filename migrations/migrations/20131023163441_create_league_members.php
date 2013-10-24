<?php

use Phinx\Migration\AbstractMigration;

class CreateLeagueMembers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('league_members');
        $table->addColumn('league_id', 'integer');
        $table->addColumn('team_id', 'integer');
        $table->addColumn('active', 'boolean', array('default'=>1));
        $table->create();
    }
}