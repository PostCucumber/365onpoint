<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facility_name');
            $table->string('contractor_name');
            $table->text('street_address');
            $table->string('fein_number');
            $table->string('contract_number');
            $table->integer('max_annual_bed_days');
            $table->integer('per_diem');
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
        Schema::dropIfExists('facility_info');
    }
}
