<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ['name', 'price', 'is_packet', "photo_url"];

    public function transactions() {
        return $this->belongsToMany(Transaction::class, 'transactions', 'product_id', 'transaction_id');
    }

    public function productItems() {
        return $this->hasMany(ProductItem::class, 'product_id', 'id');
    }
}
