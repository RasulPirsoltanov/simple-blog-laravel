<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }
    public function loginPost(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('index');
        }
        return redirect()->back()->withErrors('email adresi ve ya sifre sehfdir!');
    }
    public function logOut(){
        Auth::logout();
        return redirect()->route('login');
     }
}
