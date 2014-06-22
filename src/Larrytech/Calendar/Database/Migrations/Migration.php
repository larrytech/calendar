<?php namespace Larrytech\Calendar\Database\Migrations;

abstract class Migration {

    /**
     * Runs the migrations.
     *
     * @return void
     */
    abstract public function up();

    /**
     * Gets the 
     *
     * @return array
     */
    public function getDependentMigrations()
    {
        return array();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    abstract public function down();
    
}