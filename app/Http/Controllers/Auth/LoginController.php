<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class LoginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function login(Request $request)
    {
        // Définition des variables utilisés dans le log
        $loginStatus = '';
        $logDate = Carbon::now()->toDateTimeString();
        $userIp = $request->ip();


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentification réussit
            $loginStatus = 'Success';
            Log::info($logDate . ' – '. $loginStatus . ' : ' . $_POST['email'] . ' '. $_POST['password'] . ' - ' . $userIp);
            return redirect()->intended($this->redirectTo);
        }
        else{
            // Authentification échouée
            $loginStatus = 'Failed';
            Log::info($logDate . ' - '. $loginStatus . ' : ' . $_POST['email'] . ' '. $_POST['password'] . ' ' . $userIp);
            return redirect()->intended($this->redirectTo);
        }
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
