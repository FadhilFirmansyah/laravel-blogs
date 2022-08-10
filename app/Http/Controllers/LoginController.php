<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index():Response{
        return response()->view("login.index", [
            "title" => "Login",
            "active" => "login"
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            "email" => "required|email:dns",
            "password" => "required"
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended("/dashboard");
        }

        return back()->with("login-error", "Data input might be wrong!");
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/login");
    }
}
