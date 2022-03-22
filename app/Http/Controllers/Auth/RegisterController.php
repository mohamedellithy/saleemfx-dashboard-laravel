<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Affiliate;
use Mail;
use App\Mail\NotifyNewUserMail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required','min:10', 'max:15'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $data = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];

        if(Session::has('refrence_affiliate_id')){
            $affiliate = Affiliate::where([
                'code_affiliate' => Session::get('refrence_affiliate_id'),
                'status'         => 1
            ])->first();

            if($affiliate){
                $data['reference_affiliate_id'] = $affiliate->id;
            }
        }
        
        if(request()->has('account')){
            // affiliater
            $data['role'] = 2;
        }
        
        try {
            Mail::to(\Config::get('app.Notify_Email'))
            ->send(new NotifyNewUserMail());
        }catch(\Exception $e){}

        return User::create($data);

       
    }
    
    protected function redirectTo(){
        if (auth()->user()->role == 1) {
            return '/users';
        }
        if (auth()->user()->role == 2) {
            return '/affiliates/create';
        }
        return '/my-accounts';
    }
}
