<?php

use Phinx\Migration\AbstractMigration;

class TeamDescriptionAndPhoto extends AbstractMigration
{
    public function change()
    {
		$table = $this->table('teams');
		$table->addColumn('description', 'text');
		$table->addColumn('photo', 'string');
		$table->update();
    }
}