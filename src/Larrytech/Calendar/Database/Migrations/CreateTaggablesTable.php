<?php namespace Larrytech\Calendar\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTaggablesTable extends Migration {

    /**
     * {@inheritDoc}
     */
    public function up()
    {
        Capsule::schema()->create('taggables', function($table)
        {
            $table->integer('tag_id')->unsigned();
            $table->integer('taggable_id')->unsigned();
            $table->string('taggable_type');
            $table->timestamps();
        });
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('taggable');
    }
}