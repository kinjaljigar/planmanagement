<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustDeliveryBoyRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cust_delivery_boy_rels', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->integer('Customer_Id');
            $table->integer('Delivery_Boy_Id');
            $table->date('DoA');
            $table->boolean('isActive')->default('1');
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
        Schema::dropIfExists('cust_delivery_boy_rels');
    }
}
