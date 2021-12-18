<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
   
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('superadmin');
    }
    public function getIndex(Request $r)
    {
        $r->session()->put('redirecturlafterlogin',url()->current());
        $data['user']=User::where(['user_type'=>'user','status'=>1])->take(10)->get();
        $data['order']=Order::where(['status'=>1])->take(10)->get();
        $data['product']=Product::orderBy('id','desc')->take(10)->get();
        $data['product'] = Product::orderBy('id','desc')
        ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
        ->select('products.*','categories.name as cat_name')->take(7)->get();
        
        return view('admin.dashboard', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postLogin(Request $r)
    {
        $r->validate([
            'password' => 'required',
            'email' => 'required',
        ]);
        // dd($r->all());
        $user = Auth::attempt([
            'email' => $r->email,
            'password' => $r->password,
        ]);
        // $user=Auth::user();
        // Auth::login($user);
        return redirect('admin/dashboard');
    }
}
