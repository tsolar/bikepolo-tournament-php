<?php

use Phinx\Migration\AbstractMigration;

class AddTournamentType extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('tournaments');
        $table->addColumn('type', 'string');
        $table->update();
    }
}