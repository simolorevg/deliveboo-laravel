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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('guest_name');
            $table->string('guest_lastname');
            $table->string('guest_address');
            $table->string('guest_phone');
            $table->string('guest_mail');
            $table->timestamps();
        });
    }
    // $table->boolean('is_paid')->default(true);

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
