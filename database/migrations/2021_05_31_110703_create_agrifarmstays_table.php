<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgrifarmstaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrifarmstays', function (Blueprint $table) {
            $table->increments('AgriFarmStayId');
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
        Schema::dropIfExists('agrifarmstays');
    }
}
