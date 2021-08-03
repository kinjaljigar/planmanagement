<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_plans', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->integer('Cust_Id');
            $table->integer('Plan_Id');
            $table->integer('No_Bottle');
            $table->float('Rate');
            $table->string('Address',500);
            $table->integer('Area_Id');
            $table->string('Phone_No',30);
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
        Schema::dropIfExists('customer_plans');
    }
}
