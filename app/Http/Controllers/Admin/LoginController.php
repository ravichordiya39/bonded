<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class LoginController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function getLogin(Request $r)
    {
        return view('admin.login');
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
