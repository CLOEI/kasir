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
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->boolean('is_packet')->default(false);
            $table->string('photo_url')->nullable();
            $table->timestamps();
        });

        DB::table('products')->insert([
            ['name' => 'Super Blitz 2', 'price' => 37000, 'is_packet' => true],
            ['name' => 'Kimchi 2', 'price' => 28000, 'is_packet' => true],
            ['name' => 'Chicken Nugget Crispy', 'price' => 19500, 'is_packet' => false],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
