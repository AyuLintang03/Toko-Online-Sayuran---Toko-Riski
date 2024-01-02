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
        Schema::create('order_offlines', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('alamat')->nullable();
            $table->string('RTRW')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable(); 
              $table->enum('status', ['Belum Bayar','Lunas','Hutang'])->nullable();
             $table->bigInteger('subtotal')->default(0);
             $table->timestamp('batas_waktu')->nullable();
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_offlines');
    }
};
