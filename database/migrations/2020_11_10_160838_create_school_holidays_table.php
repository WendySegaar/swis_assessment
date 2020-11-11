<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_holidays', function (Blueprint $table) {
            $table->bigIncrements('school_holiday_id');
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
        Schema::dropIfExists('school_holidays');
    }
}
