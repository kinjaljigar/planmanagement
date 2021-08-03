<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceMasterDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_master_dealers', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->integer('Dealer_Id');
            $table->string('Name',100);
            $table->string('Address',500);
            $table->string('GST_No',50);
            $table->date('DoI');
            $table->integer('Invoice_No');
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
        Schema::dropIfExists('invoice_master_dealers');
    }
}
