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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->string('no_inv', 50);
            $table->string('kode_produk', 50);
            $table->string('nama_produk');
            $table->unsignedInteger('qty');
            $table->decimal('harga', 15, 2);
            $table->decimal('disc_1', 5, 2)->default(0.00);
            $table->decimal('disc_2', 5, 2)->default(0.00);
            $table->decimal('disc_3', 5, 2)->default(0.00);
            $table->decimal('harga_net', 15, 2);
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();

            // Definisi Foreign Key untuk no_inv
            $table->foreign('no_inv')
                  ->references('no_inv')
                  ->on('transaction_headers')
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); 

            // Definisi Foreign Key untuk kode_produk
            $table->foreign('kode_produk')
                  ->references('kode_produk')
                  ->on('products')
                  ->onUpdate('cascade')
                  ->onDelete('restrict'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};