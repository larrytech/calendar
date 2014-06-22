<?php namespace Larrytech\Calendar\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateEventsTable extends Migration {

    /**
     * {@inheritDoc}
     */
    public function up()
    {
        Capsule::schema()->create('events', function($table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->timestamps();
        });
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('events');
    }
}