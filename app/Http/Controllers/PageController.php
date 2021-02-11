<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Courier;
use App\Utils\Utils;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function showDetails ($courier_id) {
        $user = Auth::user();
        $courier = Courier::find($courier_id);
        $current_account = strtolower($user->role);
        $current_action = 'none';
        $title = 'Detail de courier';
        $courier_user = $courier->user;
        $categories = Categorie::all();
        $prestataires = Utils::$PRESTATAIRES;
        $assignments = $courier->assignes()->orderBy('position')->get();
        return view('pages.courier-details', compact('courier_user', 'assignments', 'courier', 'prestataires', 'categories', 'title', 'current_account', 'current_action'));
    }
}
