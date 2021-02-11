<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('pages.root.couriers', compact('title', 'current_account', 'current_action'));
    }
}
