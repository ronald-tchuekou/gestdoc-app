<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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

        if($user->role == 'Admin'){
            return $next($request);
        }elseif($user->role == 'Root'){
            return redirect()->intended('/root/dashboard');
        }else{
            return redirect()->intended('/agent/dashboard');
        }
    }
}