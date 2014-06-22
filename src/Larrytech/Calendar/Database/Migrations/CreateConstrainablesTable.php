<?php namespace Larrytech\Calendar\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateConstrainablesTable extends Migration {

    /**
     * {@inheritDoc}
     */
    public function up()
    {
        Capsule::schema()->create('constrainables', function($table)
        {
            $table->integer('constraint_id')->unsigned();
            $table->integer('constrainable_id')->unsigned();
            $table->string('constrainable_type');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('constraintable');
    }
}