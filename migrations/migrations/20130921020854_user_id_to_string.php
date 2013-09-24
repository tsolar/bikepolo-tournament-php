<?php

use Phinx\Migration\AbstractMigration;

class UserIdToString extends AbstractMigration
{
    public function change()
    {
		$profile_table = $this->table('profiles');
		$profile_table->changeColumn('user_id', 'string', array('limit'=>36));
		$profile_table->update();

		$sa_table = $this->table('social_accounts');
		$sa_table->changeColumn('user_id', 'string', array('limit'=>36));
		$sa_table->update();

		$players_table = $this->table('players');
		$players_table->changeColumn('user_id', 'string', array('limit'=>36));
		$players_table->update();
    }
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}