<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function show($id)
    {
        $transaksi = Transaction::with('cashier', 'transactionDetails.product')->findOrFail($id);
        return view('nota', compact('transaksi'));
    }
}
