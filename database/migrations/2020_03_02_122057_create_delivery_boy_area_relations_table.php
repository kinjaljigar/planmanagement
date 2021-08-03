<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryBoyAreaRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_boy_area_relations', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->integer('Delivery_Boy_Id');
            $table->integer('Area_Id');
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
        Schema::dropIfExists('delivery_boy_area_relations');
    }
}
