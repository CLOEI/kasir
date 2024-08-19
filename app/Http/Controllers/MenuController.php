<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('menu', ['products' => $products]);
    }

    public function add_to_cart(Request $request) {
        $product = Product::where('id', $request->product_id)->with('productItems')->first();
        $cart = $request->session()->get('cart', []);
        if ($product->is_packet) {
            $cart[] = [
                'product' => $product,
                'items' => $product->productItems
            ];
        } else {
            $cart[] = $product;
        }
        $request->session()->put('cart', $cart);
        return redirect()->route('menu');
    }

    public function cart(Request $request) {
        $cart = $request->session()->get('cart');
        return view('cart', ['cart' => $cart]);
    }
}
