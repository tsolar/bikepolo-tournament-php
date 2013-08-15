<?php

use Phinx\Migration\AbstractMigration;

class CreateSocialAccounts extends AbstractMigration
{
    public function change()
    {
		$table = $this->table('social_accounts');
		$table->addColumn('user_id', 'integer');
		$table->addColumn('provider', 'string');
		$table->addColumn('uid', 'string');
		$table->addColumn('data', 'text');
		$table->addColumn('is_active', 'boolean', array('default'=>1));
		$table->addColumn('created', 'datetime');
		$table->addColumn('modified', 'datetime');
		$table->create();
    }
}