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
        Schema::create('order_positions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_menu');
            $table->unsignedBigInteger('id_order');
            $table->decimal('price', 8, 2);
            $table->timestamps();

         // Definicja klucza obcego
         $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
         $table->foreign('id_menu')->references('id')->on('menu_positions')->onDelete('cascade');
         $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_positions');
    }
};
