<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvubookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avubookings', function (Blueprint $table) {
            $table->increments('BookingId');
			$table->string('EventName');
            $table->date('CheckInDate');
            $table->time('StartTime', $precision = 0);
            $table->time('EndTime', $precision = 0);
            $table->string('Description');
            $table->string('Status');
			$table->unsignedBigInteger('Recommendation_From')->nullable()->unsigned();
            $table->foreign('Recommendation_From')->references('id')->on('users'); 
            $table->unsignedBigInteger('GuestId');
            $table->foreign('GuestId')->references('id')->on('users'); 
            $table->string('GuestName');
            $table->integer('AVUId')->unsigned();
			$table->foreign('AVUId')->references('AVUId')->on('audiovisualunits'); 
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
        Schema::dropIfExists('avubookings');
    }
}
