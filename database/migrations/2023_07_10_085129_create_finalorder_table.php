<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalorder', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dish_order_dish_id');
            $table->unsignedBigInteger('dish_order_order_id');
            $table->foreign(['dish_order_dish_id', 'dish_order_order_id'])->references(['dish_id', 'order_id'])->on('dish_order')->onDelete('cascade');
                
            $table->float('total_price', 8, 2);
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
        Schema::dropIfExists('finalorder');
    }
};
