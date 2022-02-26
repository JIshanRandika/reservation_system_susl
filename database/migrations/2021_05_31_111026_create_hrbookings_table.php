<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrbookings', function (Blueprint $table) {
            $table->increments('BookingId');
            $table->string('BookingType');
            $table->date('CheckInDate');
			$table->date('CheckOutDate');
			$table->integer('NoOfAdults');
			$table->integer('NoOfChildren');
            $table->integer('NoOfUnits');
            $table->string('Description');
            $table->string('Status');
            $table->unsignedBigInteger('Recommendation_From')->nullable()->unsigned();
            $table->foreign('Recommendation_From')->references('id')->on('users'); 
            $table->boolean('VCApproval')->default(0);
            $table->string('GuestName');
            $table->unsignedBigInteger('GuestId');
			$table->foreign('GuestId')->references('id')->on('users'); 
            $table->integer('HolodayResortId')->unsigned();
			$table->foreign('HolodayResortId')->references('HolodayResortId')->on('holidayresorts'); 
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
        Schema::dropIfExists('hrbookings');
    }
}
