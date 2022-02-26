<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidayresortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holidayresorts', function (Blueprint $table) {
            $table->increments('HolodayResortId');
            $table->string('Type');
            $table->integer('NoOfUnits');
			$table->integer('NoOfAdults');
			$table->integer('NoOfChildren');
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
        Schema::dropIfExists('holidayresorts');
    }
}
