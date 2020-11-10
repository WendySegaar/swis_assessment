<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolholidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolholidays', function (Blueprint $table) {
            $table->bigIncrements('schoolholiday_id');
            $table->string('schoolyear', 11);
            $table->string('type', 50);
            $table->boolean('compulsory_dates')->default(1);
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
        Schema::dropIfExists('schoolholidays');
    }
}
