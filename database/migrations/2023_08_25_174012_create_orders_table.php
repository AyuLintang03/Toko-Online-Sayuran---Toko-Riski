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
            $table->text('name')->nullable();
            $table->text('alamat')->nullable();
            $table->string('RTRW')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable(); 
            $table->enum('status', ['Belum Bayar','Lunas','Konfirmasi','Diterima','Ditolak','Validasi'])->nullable();
            $table->enum('status_pengiriman', ['Pesanan belum diproses','Pesanan sedang dikemas','Pesanan sedang diantar','Pesanan diterima'])->nullable();
            $table->bigInteger('subtotal')->default(0);
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
           $table->timestamp('batas_waktu')->nullable();
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
