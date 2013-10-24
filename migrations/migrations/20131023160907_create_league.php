<?php

use Phinx\Migration\AbstractMigration;

class CreateLeague extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('leagues');
        $table->addColumn('name', 'string');
        $table->addColumn('location', 'string', array('null'=>true, 'default'=>null));
        $table->create();
    }
}