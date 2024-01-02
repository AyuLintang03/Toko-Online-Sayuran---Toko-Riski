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
        Schema::create('transaksi_order_offlines', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->text('jenis')->nullable();
            $table->foreignId('product_id')->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->foreignId('resep_id')->constrained('reseps')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('order_offline_id')->constrained('order_offlines')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_order_offline');
    }
};
