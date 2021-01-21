<?php

use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\EntreeStockController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SortieStockController;
use App\Http\Controllers\StockageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::view('/errors', 'errors');
Route::resource('/clients', ClientController::class);
Route::resource('/users', UserController::class);
Route::resource('/agences', AgenceController::class);
Route::resource('/produits', ProductController::class);
Route::resource('/emploies', EmployeController::class);
Route::resource('/entree-stock', EntreeStockController::class);
Route::resource('/sortie-stock', SortieStockController::class);
Route::resource('/stock', StockageController::class);
Route::resource('/fournisseurs', FournisseurController::class);

Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');
Route::view('/forgot-password', 'auth.forgot-password');
Route::view('/reset-password', 'auth.reset-password');
Route::view('/lock-screen', 'auth.lock-screen');
