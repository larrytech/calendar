<?php namespace Larrytech\Calendar\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateConstraintsTable extends Migration {

    /**
     * {@inheritDoc}
     */
    public function up()
    {
        Capsule::schema()->create('constraints', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('constraints');
    }
}