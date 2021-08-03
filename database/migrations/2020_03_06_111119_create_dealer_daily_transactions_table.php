<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealerDailyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_daily_transactions', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->integer('Dealer_Id');
            $table->date('DoT');
            $table->integer('No_Of_Bottle');
            $table->integer('Bottle_Type');
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
        Schema::dropIfExists('dealer_daily_transactions');
    }
}
