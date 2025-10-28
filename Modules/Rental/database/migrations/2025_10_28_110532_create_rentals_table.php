<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('rental_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->date('rental_date'); // Tanggal mulai sewa
            $table->date('due_date'); // Tanggal jatuh tempo (max 5 hari)
            $table->date('return_date')->nullable(); // Tanggal pengembalian aktual
            $table->decimal('total_price', 10, 2);
            $table->decimal('fine', 10, 2)->default(0); // Denda jika terlambat
            $table->enum('status', ['active', 'returned', 'overdue'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
