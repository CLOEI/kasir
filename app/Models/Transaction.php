<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $fillable = ['id_kasir', 'tgl_transaksi', 'tipe_pesanan', 'jumlah_bayar'];
    public $timestamps = false;

    public function cashier()
    {
        return $this->belongsTo(Cashier::class, 'id_kasir', 'name');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }
}
