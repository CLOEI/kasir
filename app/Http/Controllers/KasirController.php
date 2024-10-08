<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        return view('input');
    }

    public function login_or_register(Request $request) {
        $kasir = Cashier::where('name', $request->kasirID)->first();
        if ($kasir == null) {
            Cashier::create([
                'name' => $request->kasirID
            ]);
        }
        $request->session()->put('kasirID', $request->kasirID);
        return redirect()->route('menu');
    }
}
