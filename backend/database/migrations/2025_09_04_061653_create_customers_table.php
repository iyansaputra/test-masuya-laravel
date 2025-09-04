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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('kode_customer', 50)->primary();
            $table->string('nama_customer');
            $table->text('alamat_lengkap');
            $table->string('provinsi', 100)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE customers ADD CONSTRAINT chk_customer_kode CHECK (kode_customer REGEXP '^[A-Za-z0-9]+$')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};