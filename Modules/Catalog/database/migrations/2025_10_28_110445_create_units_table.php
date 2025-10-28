<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode unit unik
            $table->string('name'); // Nama akun
            $table->text('description')->nullable();
            $table->string('rank')->nullable(); // Iron, Bronze, Silver, dll
            $table->integer('level')->nullable();
            $table->decimal('price_per_day', 10, 2); // Harga sewa per hari
            $table->string('image')->nullable();
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
