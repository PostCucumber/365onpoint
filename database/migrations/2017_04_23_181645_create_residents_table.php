<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_initial')->nullable();
            $table->char('sex', 1);
            $table->string('race');
            $table->string('document_number');
            $table->string('service_center_number');
            $table->date('dob');
            $table->integer('age');
            $table->string('drug');
            $table->date('date_of_admission');
            $table->date('projected_date_of_discharge');
            $table->date('actual_date_of_discharge')->nullable();
            $table->string('status');
            $table->string('status_at_discharge')->nullable();
            $table->string('counselor')->nullable();
            $table->string('program_level');
            $table->date('employment_date')->nullable();
            $table->string('payment_method');
            $table->string('referral_source');
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
        Schema::dropIfExists('residents');
    }
}
