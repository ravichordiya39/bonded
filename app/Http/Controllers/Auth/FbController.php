<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FbController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookSignin()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $facebookId = User::where('facebook_id', $user->id)->orWhere('email',$user->email)->first();
     
            if($facebookId){
                Auth::login($facebookId);
                if (Session::has('redirecturlafterlogin')) {
                    $geturl = Session::get('redirecturlafterlogin');
                    Session::forget('redirecturlafterlogin');
                    return redirect()->intended($geturl);
                } else {
                    return redirect()->intended('/user/dashboard');
                }
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => encrypt('john123')
                ]);
    
                Auth::login($createUser);
                if (Session::has('redirecturlafterlogin')) {
                    $geturl = Session::get('redirecturlafterlogin');
                    Session::forget('redirecturlafterlogin');
                    return redirect()->intended($geturl);
                } else {
                    return redirect()->intended('/user/dashboard');
                }
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
    
    
    
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Google login authentication
     *
     * @return void
     */
    public function loginWithGoogle()
    {
        try {

            $googleUser = Socialite::driver('google')->user();
            $user =  User::where('google_id', $googleUser->id)->orWhere('email',$googleUser->email)->first();

            if($user){
                Auth::login($user);
                if (Session::has('redirecturlafterlogin')) {
                    $geturl = Session::get('redirecturlafterlogin');
                    Session::forget('redirecturlafterlogin');
                    return redirect()->intended($geturl);
                } else {
                    return redirect()->intended('/user/dashboard');
                };
            }

            else{
                $createUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => encrypt('test@123')
                ]);

                Auth::login($createUser);
                if (Session::has('redirecturlafterlogin')) {
                    $geturl = Session::get('redirecturlafterlogin');
                    Session::forget('redirecturlafterlogin');
                    return redirect()->intended($geturl);
                } else {
                    return redirect()->intended('/user/dashboard');
                };
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}