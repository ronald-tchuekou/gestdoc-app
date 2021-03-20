<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RootMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if($user == null)
            return redirect('login');

        if($user->role == 'Root'){
            return $next($request);
        }elseif($user->role == 'Admin'){
            return redirect()->intended('/admin/dashboard');
        }elseif($user->role == 'AppAdmin'){
            return redirect()->intended('/platfrom-administrator');
        }else{
            return redirect()->intended('/agent/dashboard');
        }
        
    }
}
