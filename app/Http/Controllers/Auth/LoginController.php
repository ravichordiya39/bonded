<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $r){
    	$validate=Validator::make($r->all(),[
    		'email'=>'required',
    		'password'=>'required',
    	]);
    	if($validate->fails()){
    		return back()->with('error',$validate->errors()->first());
    	}
    	if (Auth::attempt(['email'=>$r->email, 'password'=>$r->password])) {
    		if (Session::has('redirecturlafterlogin')) {
	            $geturl = Session::get('redirecturlafterlogin');
	            Session::forget('redirecturlafterlogin');
	            return redirect()->intended($geturl);
	        } else {
	            return redirect()->intended('/user/dashboard');
	        }
        }else{
        	return back()->with('error',WrongCredential);
        }
    }
}
