<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $val = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:4'
        ])->validate();

        if (!Auth::attempt($val, 1)) {
            return back()->with('error', 'Invalid credentials, please try again');
        }

        $this->registerLogin();

        return redirect('/pos?trno='.rand(23212,99999999))->with('success', 'Welcome back ' . auth()->user()->name);
    }



    public function registerLogin()
    {
        Login::create([
            'user_id' => auth()->user()->id, 
            'ymd' => date('ymd'),
            'timeout' => time()
        ]);
    }



    function logout()
    {
        Login::create([
            'user_id' => auth()->user()->id, 
            'ymd' => date('ymd'),
            'action' => 'logout',
            'timeout' => time()
        ]);

        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out');
    }
}
