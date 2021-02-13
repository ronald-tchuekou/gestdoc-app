<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RootController extends Controller
{
    public function index () {
        $title = 'ROOT GEST';
        $current_account =  'root';
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.root.index', compact('title', 'current_account', 'current_action'));
    }

    public function showProfileView() {
        $title = 'ROOT GEST';
        $current_account =  'root';
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.root.profile', compact('title', 'current_account', 'current_action'));
    }

    public function showParametresView() {
        $title = 'ROOT GEST';
        $current_account =  'root';
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.root.parametres', compact('title', 'current_account', 'current_action'));
    }
    
    public function showCouriersView() {
        $title = 'ROOT GEST';
        $current_account =  'root';
        $current_action = explode('/', Route::current()->uri)[1];

        $user = Auth::user();
        $agents = User::where(['role' => 1, 'register_token' => null])->get();

        $couriers_initial = Courier::where('etat', 1)
            ->orderBy('dateEnregistrement')->get();

        $couriers_modifie = Courier::where('etat', 7)
            ->orderBy('updated_at')->get();

        $couriers_traite = Courier::where('etat', 4)
            ->orderBy('updated_at')->get();

        $couriers = Courier::where('etat', 1)->get();
        return view('pages.admin.couriers', compact('user', 'agents', 'couriers_initial', 'couriers_modifie', 'couriers_traite', 'title', 'current_account', 'current_action'));
    
    }
}
