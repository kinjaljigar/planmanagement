<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryBoyBaseBottlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_boy_base_bottles', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->integer('Delivery_Boy_Id');
            $table->integer('Bottle_Id');
            $table->integer('Count');
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
        Schema::dropIfExists('delivery_boy_base_bottles');
    }
}
