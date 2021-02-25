<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;

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

    /**
     * Fonction qui permet d'authentifier un user.
     */
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
            $dashboard = '';

            if($user->role == 'Admin')
                $dashboard = '/admin/dashboard';
            elseif($user->role == 'Root')
                $dashboard = '/root/dashboard';
            else
                $dashboard = '/agent/dashboard';

            return redirect($dashboard);
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
