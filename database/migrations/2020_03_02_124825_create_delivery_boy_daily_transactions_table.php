<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryBoyDailyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_boy_daily_transactions', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->integer('Delivery_Boy_Id');
            $table->integer('Bottle_Type_Id');
            $table->string('In_Out',5);
            $table->integer('Count');
            $table->date('DoT');
            $table->string('Full_Empty',10);
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
        Schema::dropIfExists('delivery_boy_daily_transactions');
    }
}
