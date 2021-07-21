<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(
        Request $request, Closure $next, ...$guards
    )
    {
        // $guards = empty($guards) ? [null] : $guards;
        // foreach ($guards as $guard) {
            
            if (!Auth::guard('admin')->check()) {
                if(! strstr($_SERVER['REQUEST_URI'], 'admin/login')){
                return redirect('admin/login');
                }
            }
        // }

        return $next($request);
    }

        // if (Auth::guard('admin')->check())
        // {
        //     $admins = Auth::guard('admin')->user()->all();

        //     return view('admin.home')->with([
        //         "admins" => $admins,
        //     ]);
        // }else{
        //     if (strstr($_SERVER['REQUEST_URI'], 'admin/login')) {
                
        //     }else{
        //         echo'waaa';
        //         return redirect('admin/login');
        //     };
        // };
    }