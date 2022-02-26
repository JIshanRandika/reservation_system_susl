<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentTypeToColumAndTotalBookongTotal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agrsbookings', function (Blueprint $table) {
            $table->string('payment_type')->default('Not Paid');
            $table->double('payment_total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agrsbookings', function (Blueprint $table) {
            $table->dropColumn('payment_type');
            $table->dropColumn('payment_total');
        });
    }
}
