<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('input');
});

Route::get("/menu", [\App\Http\Controllers\MenuController::class, "index"])->name("menu");
Route::get("/menu/cart", [\App\Http\Controllers\MenuController::class, "cart"])->name("cart");
Route::post("/menu/add_to_cart", [\App\Http\Controllers\MenuController::class, "add_to_cart"])->name("add_to_cart");

Route::post("/login_or_register", [\App\Http\Controllers\KasirController::class, "login_or_register"])->name("login_or_register");
