<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $fillable = ['id_kasir', 'tgl_transaksi', 'tipe_pesanan'];
    public $timestamps = false;

    public function kasir() {
        return $this->belongsTo(Kasir::class, 'id_kasir', 'id');
    }
}
