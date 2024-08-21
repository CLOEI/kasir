<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('menu', ['products' => $products]);
    }

    public function add_to_cart(Request $request)
    {
        $product = Product::where('id', $request->product_id)->with('productItems')->first();
        $cart = $request->session()->get('cart', []);
        $found = false;

        foreach ($cart as &$item) {
            if (is_array($item) && $item['product']->id == $request->product_id) {
                $item['quantity'] += 1;
                $found = true;
                break;
            } elseif (!is_array($item) && $item->id == $request->product_id) {
                $item->quantity += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            if ($product->is_packet) {
                $cart[] = [
                    'product' => $product,
                    'items' => $product->productItems,
                    'quantity' => 1
                ];
            } else {
                $cart[] = [
                    'product' => $product,
                    'quantity' => 1
                ];
            }
        }

        $request->session()->put('cart', $cart);
        return redirect()->route('menu');
    }

    public function remove_from_cart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $updatedCart = [];

        foreach ($cart as $item) {
            if (is_array($item) && $item['product']->id != $request->product_id) {
                $updatedCart[] = $item;
            } elseif (!is_array($item) && $item->id != $request->product_id) {
                $updatedCart[] = $item;
            }
        }

        $request->session()->put('cart', $updatedCart);
        return redirect()->route('cart');
    }

    public function cart(Request $request)
    {
        $cart = $request->session()->get('cart');
        return view('cart', ['cart' => $cart]);
    }

    public function delete_cart(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->route('cart');
    }

    public function submit_cart(Request $request)
    {
        $id_kasir = session('kasirID');

        $transaksi = Transaction::create([
            'id_kasir' => $id_kasir,
            'tgl_transaksi' => now(),
            'tipe_pesanan' => $request->tipe_pesanan,
            'nomor_meja' => $request->nomor_meja,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        $cart = session()->get('cart', []);

        foreach ($cart as $item) {
            if (is_array($item)) {
                TransactionDetail::create([
                    'transaction_id' => $transaksi->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity']
                ]);
            } else {
                TransactionDetail::create([
                    'transaction_id' => $transaksi->id,
                    'product_id' => $item->id,
                    'quantity' => $item->quantity
                ]);
            }
        }

        session()->forget('cart');

        return redirect()->route('transaksi.show', ['id' => $transaksi->id])->with('success', 'Transaction completed successfully!');
    }

    public function update_cart_quantity(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        $cart = $request->session()->get('cart', []);

        $productFound = false;
        foreach ($cart as &$item) {
            if ($item['product']->id == $productId) {
                $productFound = true;
                if ($quantity < 1) {
                    $cart = array_filter($cart, function ($cartItem) use ($productId) {
                        return $cartItem['product']->id != $productId;
                    });
                } else {
                    $item['quantity'] = $quantity;
                }
                break;
            }
        }

        if (!$productFound) {
            return redirect()->back()->with('error', 'Product not found in cart.');
        }

        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Cart updated successfully.');
    }
}
