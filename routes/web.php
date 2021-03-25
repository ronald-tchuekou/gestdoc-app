<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PassForgotController;
use App\Http\Controllers\PlatformAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\ServiceController;
use App\Models\Courier;
use Illuminate\Support\Facades\Route;

// Auth manager routes.
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/loginOut', [LoginController::class, 'loginOut']);
Route::get('/register/{id}/{token}', [RegisterController::class, 'index']);
Route::post('/register/{user_id}', [RegisterController::class, 'store']);
Route::get('/admin-register-person', [RegisterController::class, 'registerAdministratorPersonView']);
Route::post('/admin-register-person', [RegisterController::class, 'storeAdministratorPerson']);
Route::get('/admin-register', [RegisterController::class, 'registerAdministratorView']);
Route::post('/admin-register', [RegisterController::class, 'storeAdministrator']);
Route::get('/forgot-password', [PassForgotController::class, 'index']);
Route::post('/forgot-password/send', [PassForgotController::class, 'sendMail']);
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index']);
Route::post('/reset-password/reset/{id}', [ResetPasswordController::class, 'reset']);

Route::get('/get-courrier-info-{id}', function ($id) {
    $courrier = Courier::find($id);

    $courrier->assignes->toJson();

    if($courrier->reject != null):
        $courrier->reject->toJson();
    endif;

    if($courrier->service != null):
        $courrier->service->toJson();
    endif;

    if($courrier->categorie != null):
        $courrier->categorie->toJson();
    endif;
    
    if($courrier->to_modify != null):
        $courrier->to_modify->toJson();
    endif;

    if($courrier->valide != null):
        $courrier->valide->toJson();
    endif;

    $courrier->personne->toJson();

    return response ($courrier->toJson(), 200);
});

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

        Route::get('/categories', [CategoryController::class, 'index']);
        Route::post('/categories/store', [CategoryController::class, 'store']);
        Route::get('/categories/delete/{id}', [CategoryController::class, 'delete']);
        Route::post('/categories/update/{id}', [CategoryController::class, 'update']);

        Route::get('/services', [ServiceController::class, 'index']);
        Route::post('/services/store', [ServiceController::class, 'store']);
        Route::get('/services/delete/{id}', [ServiceController::class, 'delete']);
        Route::post('/services/update/{id}', [ServiceController::class, 'update']);

        Route::get('/agents', [AdminController::class, 'showAgentsView']);
        Route::get('/agents/add', [AdminController::class, 'showAddAgentView']);
        Route::post('/agents/store', [AdminController::class, 'storeAgent']);
        Route::get('/agents/{id}/edit', [AdminController::class, 'showEditAgentView']);
        Route::get('/agents/{id}/delete', [AdminController::class, 'deleteAgent']);
        Route::get('/agents/{id}/details', [AdminController::class, 'showAgentView']);
        Route::post('/agents/{id}/update', [AdminController::class, 'update_agent']);

        Route::get('/couriers', [CourrierController::class, 'adminCourrierIndex']);
        Route::post('/couriers/assignment', [CourrierController::class, 'assignCourier']);
        Route::get('/couriers/{id}/{reason}/modify', [CourrierController::class, 'add_to_modify']);
        Route::get('/couriers/{id}/{reason}/reject', [CourrierController::class, 'add_to_reject']);
        Route::get('/couriers/validate/{id}', [CourrierController::class, 'validate_courier']);

        Route::get('/handle-new-courrier-init', [CourrierController::class, 'handleNewCourrierInit']);

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

});

// Accueil routes managers
Route::middleware(['auth', 'authAccueil'])->prefix('accueil')->group(function(){

    Route::get('/dashboard', [AccueilController::class, 'index']);
    Route::get('/profile', [AccueilController::class, 'showProfileView']);
    Route::get('/parametres', [AccueilController::class, 'showParametresView']);

    Route::get('/couriers', [AccueilController::class, 'showCouriersView']);
    Route::get('/couriers/add', [AccueilController::class, 'showAddCouriersView']);
    Route::post('/couriers/store', [CourrierController::class, 'store']);
    Route::post('/couriers/item/{id}/update', [CourrierController::class, 'update']);
    Route::get('/couriers/{id}', [AccueilController::class, 'showCourier']);
    Route::get('/couriers/{id}/edit', [AccueilController::class, 'editCourierShowView']);
    Route::get('/couriers/{id}/modify', [AccueilController::class, 'modifyCourier']);
    Route::get('/couriers/{id}/finish', [AccueilController::class, 'finishCourier']);

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

    Route::get('/handleChange/{user_id}', [AgentController::class, 'handleChange']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/appadmin/root-account/add', [PlatformAdminController::class, 'showAddRootView']);
    Route::get('/appadmin/accueil-account/add', [PlatformAdminController::class, 'showAddAccueilView']);
    Route::get('/appadmin/root-account/{id}', [PlatformAdminController::class, 'showEditRootView']);
    Route::get('/appadmin/accueil-account/{id}', [PlatformAdminController::class, 'showEditAccueilView']);
    Route::post('/appadmin/root-manager/store', [PlatformAdminController::class, 'storeRootAccount']);
    Route::post('/appadmin/accueil-manager/store', [PlatformAdminController::class, 'storeAccueilAccount']);
    Route::post('/appadmin/root-manager/{id}/update', [PlatformAdminController::class, 'updateAccount']);
    Route::post('/appadmin/accueil-manager/{id}/update', [PlatformAdminController::class, 'updateAccount']);
    Route::get('/appadmin/root-accueil/{id}/details', [RootController::class, 'showAdjointView']);
    Route::get('/appadmin/accueil-account/{id}/details', [RootController::class, 'showAdjointView']);
    Route::get('/appadmin/root-account/{id}/delete', [PlatformAdminController::class, 'deleteUser']);
    Route::get('/appadmin/profile', [AgentController::class, 'showProfileView']);
    Route::get('/courrier/info/all/{id}', [CourrierController::class, 'getCourrierIfon']);
    Route::post('/profile/update-password', [ProfileController::class, 'update_pass']);
    Route::post('/profile/upload-profile', [ProfileController::class, 'upload_profile']);

    // Route to platform administrator views.
    Route::get('/platfrom-administrator', [PlatformAdminController::class, 'index']);
});

Route::get('/statistiquesCourriers/{from}', [AdminController::class, 'get_statCourrierBetween']);
Route::get('/statistiquesAgents', [AdminController::class, 'get_statAgentBetween']);


// This is for all users.
$allUsers = [
    [
        'mid' => 'authAdmin',
        'prefix' => 'admin',
    ],
    [
        'mid' => 'authRoot',
        'prefix' => 'root',
    ],
    [
        'mid' =>  'authAccueil',
        'prefix' => 'accueil',
    ],
    [
        'mid' => 'authAgent',
        'prefix' =>  'agent',
    ],
    [
        'mid' => 'auth',
        'prefix' =>  'appadmin',
    ],
];

foreach ($allUsers as $account) {
    Route::middleware(['auth', $account['mid']])->prefix($account['prefix'])->group(function(){

        Route::get('/courier-details/{courier_id}', [CourrierController::class, 'show']);
        Route::get('/courriers/marck-as-not-recieved/{id}', [CourrierController::class, 'marckAsNotRecieved']);
        Route::get('/courriers/marck-as-recieved/{id}', [CourrierController::class, 'marckAsRecieved']);
        Route::post('/courriers/add-observation', [CourrierController::class, 'setObservation']);

        Route::get('/localisations', [LocationController::class, 'index']);
        Route::post('/localisations/store', [LocationController::class, 'store']);
        Route::get('/localisations/delete/{id}', [LocationController::class, 'delete']);
        Route::post('/localisations/update/{id}', [LocationController::class, 'update']);

    });
}