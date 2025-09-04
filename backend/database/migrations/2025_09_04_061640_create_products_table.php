<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('kode_produk', 50)->primary();
            $table->string('nama_produk');
            $table->decimal('harga', 15, 2);
            $table->unsignedInteger('stok')->default(0);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE products ADD CONSTRAINT chk_produk_kode CHECK (kode_produk REGEXP '^[A-Za-z0-9]+$')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
