<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use \App\Models\User;

class LoginController extends Controller
{
    protected $redirectTo;

    public function __construct() {
        $this->redirectTo = '/'.getAdminUrl();
        $this->middleware('guest')->except('logout');
    }

    public function showLogin() {
        $data = [
            'pageTitle' => 'Login'
        ];

        return view('admin.auth.login', $data);
    }

    public function login(Request $request) {
        $validate = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $loginValue = $request['username'];
        $username = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($username, $request['username'])->first();

        if(!empty($user) && $user->status === User::$active){

            if(Auth::attempt([$username => $request['username'], 'password' => $request['password']],$request['remember'])){
                $request->session()->regenerate();
                return redirect(getAdminUrl());
            }

            if(Auth::viaRemember()){
                return 'Remember Success';
            }

            $message = 'Wrong password.';
        }else{
            $message = 'This account not approved yet or this account not exits.';
        }

        return redirect()->back()->withInput($request->only('username','remember'))->withErrors([
            'password' => $message
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
