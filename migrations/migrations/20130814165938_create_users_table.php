<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
		$table = $this->table('users');
		$table->addColumn('email', 'string');
		$table->addColumn('username', 'string');
		$table->addColumn('password', 'string');
		$table->addColumn('is_active', 'boolean', array('default'=>1));
		$table->addColumn('last_login', 'datetime', array('null'=>true, 'default'=>null));
		$table->addColumn('created', 'datetime');
		$table->addColumn('modified', 'datetime');
		$table->create();
    }
}