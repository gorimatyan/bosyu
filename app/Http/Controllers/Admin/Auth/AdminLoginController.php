<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $request = new Request;
        $this->middleware('guest')->except('logout');
        
    
    }

    public function logout(Request $request){
        
    Auth::logout();

    //dd($request);
    
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/home');
    }

    public function login(Request $request)
    {
        $email = $request->input('id');
        $password = $request->input('password');
        $remember = $request->input('remember');

        if (Auth::attempt(['id' => $id, 'password' => $password],$remember)) 
        {  
            // 認証に成功した

            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'id' => 'The provided credentials do not match our records.',
        ]);
    }
}
