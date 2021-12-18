<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $r)
    {
       
        $validator = Validator::make($r->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone'=> 'required|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            $msg = $messages[0];
            return response()->json(['statusCode' => 401, 'message' => $msg]);
        }
        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'phone' => $r->phone,
            'country_code' => $r->country_code??91,
            'password' => Hash::make($r->password),
        ]);
        if($user){
            event(new Registered($user));
            Auth::login($user);
            $data['message'] = AddCart;
            $data['statusCode'] = 200;
            $data['message'] = 'User Login Successfully';
            return response()->json($data,200);
       }else{
        
        $data['statusCode'] = 201;
        $data['message'] =  'Please try Again';
        return response()->json($data,200);
       }
       
    }
}
