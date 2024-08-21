<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('id_kasir', 255)->collation('utf8mb4_unicode_ci');
            $table->foreign('id_kasir')->references('name')->on('cashiers')->onDelete('cascade');
            $table->timestamp('tgl_transaksi');
            $table->integer('jumlah_bayar');
            $table->enum('tipe_pesanan', ['Dine In', 'Take Away', 'Delivery']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
