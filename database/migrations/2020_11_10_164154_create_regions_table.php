<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->bigIncrements('region_id');
            $table->string('region', 50);
            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->bigInteger('school_holiday_id');
            $table->foreign('school_holiday_id')->references('school_holiday_id')->on('school_holidays');

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
        Schema::dropIfExists('regions');
    }
}
