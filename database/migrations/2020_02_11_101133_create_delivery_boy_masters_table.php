<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryBoyMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_boy_masters', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->string('Name',100);
            $table->string('Address',500);
            $table->string('Phone_No',30);
            $table->string('Vehicle_No',50);
            $table->string('Vehical_Type',50);
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
        Schema::dropIfExists('delivery_boy_masters');
    }
}
