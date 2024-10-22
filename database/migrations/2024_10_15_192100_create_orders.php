<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_token')->unique()->nullable();
            $table->unsignedBigInteger('id_admin_order');
            $table->unsignedBigInteger('id_restaurant');
            $table->datetime('end_time');
            $table->timestamps();

            $table->foreign('id_admin_order')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_restaurant')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
