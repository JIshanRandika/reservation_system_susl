<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgrsbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrsbookings', function (Blueprint $table) {
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
            $table->integer('AgriFarmStayId')->unsigned();
			$table->foreign('AgriFarmStayId')->references('AgriFarmStayId')->on('agrifarmstays'); 
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
        Schema::dropIfExists('agrsbookings');
    }
}
