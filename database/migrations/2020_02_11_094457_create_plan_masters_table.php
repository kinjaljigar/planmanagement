<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_masters', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->string('Name',50);
            $table->string('Plan_Type',15);
            $table->float('Rate');
            $table->integer('Bottle_Type_Id');
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
        Schema::dropIfExists('plan_masters');
    }
}
