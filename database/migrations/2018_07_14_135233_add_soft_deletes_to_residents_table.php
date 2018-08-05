<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesToResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dateTime('soft_deleted_at')->nullable();
            $table->dateTime('restored_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn('soft_deleted_at');
            $table->dropColumn('restored_at');
        });
    }
}
