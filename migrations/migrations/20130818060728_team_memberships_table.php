<?php

use Phinx\Migration\AbstractMigration;

class TeamMembershipsTable extends AbstractMigration
{
     /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('players_teams');
        $table->rename('team_memberships');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $table = $this->table('team_memberships');
        $table->rename('players_teams');
    }
}