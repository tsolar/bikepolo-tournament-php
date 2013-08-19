<?php

use Phinx\Migration\AbstractMigration;

class AddDescriptionToPlayer extends AbstractMigration
{
    public function change()
    {
		$table = $this->table('players');
		$table->addColumn('description', 'text', array('null'=>true));
		$table->update();
    }
}