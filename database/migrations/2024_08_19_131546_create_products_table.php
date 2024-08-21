<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
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
            ['name' => 'Super Blitz 2', 'price' => 37000, 'is_packet' => true, 'photo_url' => '/assets/blitz2.jpeg'],
            ['name' => 'Kimchi 2', 'price' => 28000, 'is_packet' => true, 'photo_url' => '/assets/kimchi.jpeg'],
            ['name' => 'Chicken Nugget Crispy', 'price' => 19500, 'is_packet' => false, 'photo_url' => '/assets/nugget.jpeg'],
            ['name' => 'Sweecy Rice Box', 'price' => 21000, 'is_packet' => false, 'photo_url' => '/assets/sweecy.webp'],
            ['name' => 'Blackpepper Rice Box', 'price' => 20000, 'is_packet' => false, 'photo_url' => '/assets/blackpepper.webp'],
            ['name' => 'Super Blitz Hemat Mineral', 'price' => 27200, 'is_packet' => true, 'photo_url' => '/assets/hemat.webp'],
            ['name' => 'Redol', 'price' => 17.000, 'is_packet' => false, 'photo_url' => '/assets/redol.webp'],
            ['name' => 'Strawberry Float', 'price' => 14000, 'is_packet' => false, 'photo_url' => '/assets/strawberry.webp'],
            ['name' => 'Lafanta Blitz', 'price' => 14000, 'is_packet' => false, 'photo_url' => '/assets/lafanta.webp'],
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
