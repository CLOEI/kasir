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
            $table->foreignId('id_kasir')->constrained('cashiers', 'name');
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
