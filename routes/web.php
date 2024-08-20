<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('input');
});

Route::get("/menu", [\App\Http\Controllers\MenuController::class, "index"])->name("menu");
Route::get("/menu/cart", [\App\Http\Controllers\MenuController::class, "cart"])->name("cart");
Route::post("/menu/add_to_cart", [\App\Http\Controllers\MenuController::class, "add_to_cart"])->name("add_to_cart");
Route::post("/menu/remove_from_cart", [\App\Http\Controllers\MenuController::class, "remove_from_cart"])->name("remove_from_cart");
Route::post("/menu/delete_cart", [\App\Http\Controllers\MenuController::class, "delete_cart"])->name("delete_cart");
Route::post("/menu/submit_cart", [\App\Http\Controllers\MenuController::class, "submit_cart"])->name("submit_cart");

Route::post("/login_or_register", [\App\Http\Controllers\KasirController::class, "login_or_register"])->name("login_or_register");

Route::get('/transaksi/{id}', [TransactionController::class, 'show'])->name('transaksi.show');
