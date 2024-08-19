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
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('product_id')->constrained('products');
            $table->timestamps();
        });

        DB::table('product_items')->insert([
            ['name' => 'Dada', 'product_id' => 1],
            ['name' => 'Paha Bawah', 'product_id' => 1],
            ['name' => 'Nasi', 'product_id' => 1],
            ['name' => 'Teh Obeng', 'product_id' => 1],
            ['name' => 'Cola', 'product_id' => 2],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_items');
    }
};
