<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurationColumAndPaymentTotalColum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agridbookings', function (Blueprint $table) {
            $table->double('duration')->default(0);
            $table->double('payment_amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agridbookings', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dropColumn('payment_amount');
        });
    }
}
