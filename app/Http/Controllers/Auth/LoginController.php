<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    public function __construct()
    {
        if (auth()->user()->isAdmin()):
            $this->redirectTo  = '/users';
        elseif (auth()->user()->isUser()):
            $this->redirectTo  = '/my-accounts';
        endif;

        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo(){
        if (auth()->user()->isAdmin()) {
            return '/users';
        }
        if (auth()->user()->isUser()) {
            return '/my-accounts';
        }
        return '/affiliates/create';
    }

    public function username(){
        // if(filter_var(request()->input('email'),FILTER_VALIDATE_EMAIL)){
        //     return 'email';
        // }
        //return 'username';
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'username';
        request()->merge([$field => request()->email]);
        return $field;
    }
}
