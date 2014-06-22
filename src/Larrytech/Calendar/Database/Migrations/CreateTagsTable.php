<?php namespace Larrytech\Calendar\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTagsTable extends Migration {

    /**
     * {@inheritDoc}
     */
    public function up()
    {
        Capsule::schema()->create('tags', function($table)
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
        Capsule::schema()->dropIfExists('tags');
    }
}