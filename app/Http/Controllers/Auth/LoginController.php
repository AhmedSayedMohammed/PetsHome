<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth as AuthUser; 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Socialite;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProviderFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFacebook()
    {
        $gituser = Socialite::driver('facebook')->user();
   
        if (User::where('email','=',$gituser->getEmail())->exists())
         {
           $user =User::where('email','=',$gituser->getEmail())->first();
            AuthUser::login($user,true);
         }
         else
         {
            $user= new User();
            $user->name=$gituser->getName();
            $user->email=$gituser->getEmail();
            $user->password='12345678As';
            $user->avatar=$gituser->getAvatar();
            if($user->save())
            {
               AuthUser::login($user,true);
            }
        }
        return redirect($this->redirectTo);
    }
        public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $gituser = Socialite::driver('github')->user();
   
        if (User::where('email','=',$gituser->getEmail())->exists())
         {
           $user =User::where('email','=',$gituser->getEmail())->first();
            AuthUser::login($user,true);
         }
         else
         {
            $user= new User();
            $user->name=$gituser->getName();
            $user->email=$gituser->getEmail();
            $user->password='12345678As';
            $user->avatar=$gituser->getAvatar();
            if($user->save())
            {
               AuthUser::login($user,true);
            }
        }
        return redirect($this->redirectTo);
        // $user->token;
    }
}
