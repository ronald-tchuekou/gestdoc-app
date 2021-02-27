<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PassForgotController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RootController;
use Illuminate\Support\Facades\Route;

// Auth manager routes.
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/loginOut', [LoginController::class, 'loginOut']);
Route::get('/register/{id}/{token}', [RegisterController::class, 'index']);
Route::post('/register/{user_id}', [RegisterController::class, 'store']);
Route::get('/forgot-password', [PassForgotController::class, 'index']);
Route::post('/forgot-password/send', [PassForgotController::class, 'sendMail']);
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index']);
Route::post('/reset-password/reset/{id}', [ResetPasswordController::class, 'reset']);

Route::get('/all-activities', [AdminController::class, 'showAllActivities'])->middleware('auth');

$accounts = [
    [
        'mid' => 'authAdmin',
        'prefix' => 'admin',
    ],
    [
        'mid' => 'authRoot',
        'prefix' => 'root',
    ],
];

// ADMIN AND ROOT
foreach ($accounts as $account) {
    Route::middleware(['auth', $account['mid']])->prefix($account['prefix'])->group(function(){

        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::get('/profile', [AdminController::class, 'showProfileView']);
        Route::get('/parametres', [AdminController::class, 'showParametresView']);

        Route::get('/categories', [AdminController::class, 'showCategoriesView']);
        Route::post('/categories/store', [AdminController::class, 'storeCategory']);
        Route::get('/categories/delete/{id}', [AdminController::class, 'deleteCategory']);
        Route::post('/categories/update/{id}', [AdminController::class, 'updateCategory']);

        Route::get('/agents', [AdminController::class, 'showAgentsView']);
        Route::get('/agents/add', [AdminController::class, 'showAddAgentView']);
        Route::post('/agents/store', [AdminController::class, 'storeAgent']);
        Route::get('/agents/{id}/edit', [AdminController::class, 'showEditAgentView']);
        Route::get('/agents/{id}/delete', [AdminController::class, 'deleteAgent']);
        Route::get('/agents/{id}/details', [AdminController::class, 'showAgentView']);
        Route::post('/agents/{id}/update', [AdminController::class, 'update_agent']);
        Route::get('/agents/edition/{id}', [AdminController::class, 'redirectToEditView']);

        Route::get('/couriers', [AdminController::class, 'showCouriersView']);
        Route::post('/couriers/assignment', [AdminController::class, 'assignCourier']);
        Route::get('/couriers/{id}/{reason}/modify', [AdminController::class, 'add_to_modify']);
        Route::get('/couriers/{id}/{reason}/reject', [AdminController::class, 'add_to_reject']);
        Route::get('/couriers/validate/{id}', [AdminController::class, 'validate_courier']);

        Route::get('/courier-details/{courier_id}', [PageController::class, 'showDetails']);

        Route::get('/handle-new-courrier-init', [AdminController::class, 'handleNewCourrierInit']);

    });
}

// Root routes managers
Route::middleware(['auth', 'authRoot'])->prefix('root')->group(function(){

    Route::get('/adjoints', [RootController::class, 'showAdjointsView']);
    Route::get('/adjoints/add', [RootController::class, 'showAddAdjointView']);
    Route::post('/adjoints/store', [RootController::class, 'storeAdjoint']);
    Route::get('/adjoints/{id}/edit', [RootController::class, 'showEditAdjointView']);
    Route::get('/adjoints/{id}/delete', [RootController::class, 'deleteAdjoint']);
    Route::get('/adjoints/{id}/details', [RootController::class, 'showAdjointView']);
    Route::post('/adjoints/{id}/update', [RootController::class, 'update_adjoint']);
    Route::get('/adjoints/edition/{id}', [RootController::class, 'redirectToEditView']);

});

// Accueil routes managers
Route::middleware(['auth', 'authAccueil'])->prefix('accueil')->group(function(){

    Route::get('/dashboard', [AccueilController::class, 'index']);
    Route::get('/profile', [AccueilController::class, 'showProfileView']);
    Route::get('/parametres', [AccueilController::class, 'showParametresView']);
    Route::get('/couriers', [AccueilController::class, 'showCouriersView']);
    Route::get('/couriers/add', [AccueilController::class, 'showAddCouriersView']);
    Route::post('/couriers/store', [AccueilController::class, 'storeCourier']);
    Route::put('/couriers/update/{id}', [AccueilController::class, 'updateCourier']);
    Route::get('/couriers/{id}', [AccueilController::class, 'showCourier']);
    Route::get('/couriers/{id}/edit', [AccueilController::class, 'editCourierShowView']);
    Route::get('/couriers/{id}/modify', [AccueilController::class, 'modifyCourier']);
    Route::get('/couriers/{id}/finish', [AccueilController::class, 'finishCourier']);

    Route::get('/courier-details/{courier_id}', [PageController::class, 'showDetails']);

    Route::get('/handleChange/{user_id}', [AccueilController::class, 'handleChange']);
    Route::get('/all-init-courriers/{user_id}', [AccueilController::class, 'allInitCourriers']);
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

    Route::get('/handleChange/{user_id}', [AgentController::class, 'handleChange']);
});

Route::middleware(['auth'])->group(function(){
    Route::post('/profile/update-password', [ProfileController::class, 'update_pass']);
    Route::post('/profile/upload-profile', [ProfileController::class, 'upload_profile']);
});

Route::get('/statistiquesCourriers/{from}', [AdminController::class, 'get_statCourrierBetween']);
Route::get('/statistiquesAgents', [AdminController::class, 'get_statAgentBetween']);
