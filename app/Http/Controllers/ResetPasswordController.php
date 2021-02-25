<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index () {
        return view('auth.reset-password');
    }


    public function resetpass(Request $request){

    }
}
