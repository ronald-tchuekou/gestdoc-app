<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RootController;
use Illuminate\Support\Facades\Route;

// Auth manager routes.
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/loginOut', [LoginController::class, 'loginOut']);
Route::get('/register/{id}/{token}', [RegisterController::class, 'index']);
Route::post('/register/{user_id}', [RegisterController::class, 'store']);

Route::view('/forgot-password', function () { return 'This is my new route.';}/*'auth.forgot-password'*/);
Route::view('/reset-password', 'auth.reset-password');

// Admin routes managers
Route::middleware(['auth', 'authAdmin'])->prefix('admin')->group(function(){

    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/profile', [AdminController::class, 'showProfileView']);
    Route::get('/parametres', [AdminController::class, 'showParametresView']);

    Route::get('/agents', [AdminController::class, 'showAgentsView']);
    Route::get('/agents/add', [AdminController::class, 'showAddAgentView']);
    Route::post('/agents/store', [AdminController::class, 'storeAgent']);
    Route::get('/agents/{id}/edit', [AdminController::class, 'showEditAgentView']);
    Route::get('/agents/{id}/details', [AdminController::class, 'showEditAgentView']);

    Route::get('/couriers', [AdminController::class, 'showCouriersView']);
    Route::post('/couriers/assignment', [AdminController::class, 'assignCourier']);
    Route::get('/couriers/{id}/{reason}/modify', [AdminController::class, 'add_to_modify']);
    Route::get('/couriers/{id}/{reason}/reject', [AdminController::class, 'add_to_reject']);
    Route::get('/couriers/validate/{id}', [AdminController::class, 'validate_courier']);

    Route::get('/courier-details/{courier_id}', [PageController::class, 'showDetails']);

});

// Root routes managers
Route::middleware(['auth', 'authRoot'])->prefix('root')->group(function(){

    Route::get('/dashboard', [RootController::class, 'index']);
    Route::get('/profile', [RootController::class, 'showProfileView']);
    Route::get('/parametres', [RootController::class, 'showParametresView']);
    Route::get('/couriers', [RootController::class, 'showCouriersView']);

    Route::get('/courier-details/{courier_id}', [PageController::class, 'showDetails']);
});

// Agent routes managers
Route::middleware(['auth', 'authAgent'])->prefix('agent')->group(function(){

    Route::get('/dashboard', [AgentController::class, 'index']);
    Route::get('/profile', [AgentController::class, 'showProfileView']);
    Route::get('/parametres', [AgentController::class, 'showParametresView']);
    Route::get('/couriers', [AgentController::class, 'showCouriersView']);
    Route::get('/couriers/add', [AgentController::class, 'showAddCouriersView']);
    Route::post('/couriers/store', [AgentController::class, 'storeCourier']);
    Route::put('/couriers/update/{id}', [AgentController::class, 'updateCourier']);
    Route::get('/couriers/{id}', [AgentController::class, 'showCourier']);
    Route::get('/couriers/{id}/edit', [AgentController::class, 'editCourierShowView']);
    Route::get('/couriers/{id}/modify', [AgentController::class, 'modifyCourier']);
    Route::get('/couriers/{id}/finish', [AgentController::class, 'finishCourier']);

    Route::get('/courier-details/{courier_id}', [PageController::class, 'showDetails']);
});

