<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerBoyDailyRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_boy_daily_relations', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->integer('Customer_Id');
            $table->integer('Delivery_Boy_Id');
            $table->date('DoA');
            $table->tinyInteger('isActive');
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
        Schema::dropIfExists('customer_boy_daily_relations');
    }
}
