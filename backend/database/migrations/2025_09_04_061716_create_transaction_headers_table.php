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
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->string('no_inv', 50)->primary();
            $table->date('tgl_inv');
            $table->string('kode_customer', 50);
            $table->string('nama_customer');
            $table->text('alamat_customer')->nullable();
            $table->decimal('total', 15, 2)->default(0.00);
            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('kode_customer')
                  ->references('kode_customer')
                  ->on('customers')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_headers');
    }
};