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
            $table->unsignedBigInteger('ID_Order');
            $table->unsignedBigInteger('ID_Sach');
            $table->integer('SoLuong');
            $table->decimal('Gia', 10, 2);
            $table->foreign('ID_Order')->references('id')->on('orders');
            $table->foreign('ID_Sach')->references('id')->on('books');
            $table->timestamps();
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
