<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility', function (Blueprint $table) {
            $table->increments('id');
            $table->string('region');
            $table->text('district');
            $table->text('sub_district');
            $table->text('facility');
            $table->text('coordinates');


            $table->string('bcg');
            $table->string('opv');
            $table->string('penta');
            $table->string('pneumo');
            $table->string('rota');


            $table->string('measles_rubella');
            $table->string('yellow_fever');
            $table->string('meningitis_a');
            $table->string('vitamin_a_dose');
            $table->string('nutrition_services');

            $table->string('phone');
            $table->string('email');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("facility");
    }
}
