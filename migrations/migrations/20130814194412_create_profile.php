<?php

use Phinx\Migration\AbstractMigration;

class CreateProfile extends AbstractMigration
{
    public function change()
    {
		$table = $this->table('profiles');
		$table->addColumn('user_id', 'string');
		$table->addColumn('gender', 'string', array('null'=>true, 'default'=>null));
		$table->addColumn('first_name', 'string', array('null'=>true, 'default'=>null));
		$table->addColumn('last_name', 'string', array('null'=>true, 'default'=>null));
		$table->addColumn('location', 'string', array('null'=>true, 'default'=>null));
		$table->addColumn('birth_date', 'date', array('null'=>true, 'default'=>null));
		$table->addColumn('timezone', 'string', array('null'=>true, 'default'=>null));
		$table->addColumn('locale', 'string', array('null'=>true, 'default'=>null));

		$table->addColumn('created', 'datetime');
		$table->addColumn('modified', 'datetime');
		$table->create();
    }
}