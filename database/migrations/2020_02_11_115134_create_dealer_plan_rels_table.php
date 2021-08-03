<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealerPlanRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_plan_rels', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->integer('Dealer_Id');
            $table->integer('Plan_Id');
            $table->float('Rate');
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
        Schema::dropIfExists('dealer_plan_rels');
    }
}
