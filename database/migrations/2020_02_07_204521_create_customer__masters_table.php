<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer__masters', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->string('Agency_Name',100);
            $table->string('Cust_Name',100);
            $table->string('Address',500);
            $table->integer('Area_Id');
            $table->string('Phone_No',30);
            $table->date('DoB');
            $table->string('GST_No',50);
            $table->string('isActive',10);
            $table->date('Created_Date');
            $table->date('Modified_Date');
            $table->date('Start_Date');
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
        Schema::dropIfExists('customer__masters');
    }
}
