<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Image;
use Validator;

class IndexController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user');
    }
    public function index(Request $r){
        $data['user']=Auth::user();
        $data['layout']=getLayout();
    	$data['data']='';
        return view('user/dashboard',$data);
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
        if($r->isMethod('post')){

        }
        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone'=> 'required|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'phone' => $r->phone,
            'country_code' => $r->country_code??91,
            'password' => Hash::make($r->password),
        ]);
        event(new Registered($user));
        Auth::login($user);
        redirect()->back();
    }

    public function editProfile(Request $r){
        if($r->isMethod('post')){
            $user =Auth::user();
            $validate=Validator::make($r->all(),[
                'name' => 'required|string|max:255',
                 'email' => 'required|string|email|unique:users,email,'.$user->id,
                'phone'=> 'required|unique:users,phone,'.$user->id,
                //'password' => ['confirmed', Rules\Password::defaults()]
            ]);
            if($validate->fails()){
                return back()->with('error',$validate->errors()->first())->withInput();
            }
            $imgTest = 0;
            $imagename='';
            if($r->file('image') && is_file($r->file('image'))){
                $imgTest = 1;
            $image = $r->file('image');
            $imagename =  $r->name.time().rand(1000,1).'.'.$image->getClientOriginalExtension();
            $destinationPath = getcwd().'/storage/app/user/thumbnails/';
            $img = Image::make($image->getRealPath());
            $img->resize(768, 1024, function ($constraint) {
                        // $constraint->aspectRatio();
                    })->save($destinationPath.$imagename);
            }
           
            $user->name = $r->name;
            $user->email = $r->email;
            if(isset($r->password) && $r->password!='' ){
                $user->password = Hash::make($r->password);
            }
            if($imgTest==1 ){
                $user->image =  $imagename;
            }
            $user->phone = $r->phone;
            $user->country_code =$r->country_code??91;
            $user->save();
            redirect()->back();
        }
      

        $data['user']=Auth::user();
        $data['layout']=getLayout();
    	$data['data']='';
        return view('user/edit-profile',$data);
    }
}
