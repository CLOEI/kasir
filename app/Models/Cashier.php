<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;
    protected $table = "cashiers";
    protected $fillable = ['name'];
    public $timestamps = false;

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_kasir', 'name');
    }
}
