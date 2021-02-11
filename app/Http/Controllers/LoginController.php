<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index () {
        $user = Auth::user();
        if($user != null){
            if($user->role == 'Admin')
                return redirect()->intended('/admin/dashboard');
            elseif($user->role == 'Root')
                return redirect()->intended('/root/dashboard');
            else
                return redirect()->intended('/agent/dashboard');
        }
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $remember = $request->has('remember');
        $credentials = $request->only('login', 'password');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Update last connexion.
            $currentUser = User::find($user->id);
            $currentUser->last_connexion = now();
            $currentUser->update();

            // Set the correct page.
            if($user->role == 'Admin')
                return redirect()->intended('/admin/dashboard');
            elseif($user->role == 'Root')
                return redirect()->intended('/root/dashboard');
            else
                return redirect()->intended('/agent/dashboard');
        }

        return back()->withErrors([
            'mgs' => 'Votre login ou mot de passe est incorrect.',
        ])->withInput($request->all());
    }

    public function loginOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
