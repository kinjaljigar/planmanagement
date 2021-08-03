<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealerMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_masters', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->string('Dealer_Name',100);
            $table->string('Address',100);
            $table->integer('Area_Id');
            $table->string('Phone_No',30);
            $table->string('Agency_Name',100);
            $table->string('GST_No',50);
            $table->string('Vehicle_No',50);
            $table->string('Vehicle_Type',50);
            $table->string('Email_id',50);
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
        Schema::dropIfExists('dealer_masters');
    }
}
