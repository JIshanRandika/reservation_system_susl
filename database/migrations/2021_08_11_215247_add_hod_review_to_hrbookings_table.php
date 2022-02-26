<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHodReviewToHrbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrbookings', function (Blueprint $table) {

            $table->string('HODComment')->nullable();
            $table->string('VCComment')->nullable();
            $table->string('RegComment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hrbookings', function (Blueprint $table) {
            
            $table->dropColumn('HODComment');
            $table->dropColumn('VCComment');
            $table->dropColumn('RegComment');
        });
    }
}
