<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index():Response{
        return response()->view("register.index", [
            "title" => "Register",
            "active" => "register"
        ]);
    }

    public function store(Request $request):RedirectResponse{
        $resultValidated = $request->validate([
            "name" => "required|max:255",
            "username" => "required|min:3|max:150|unique:users",
            "email" => "required|email:dns|unique:users",
            "password" => "required|min:8|max:255"
        ]);

        // $resultValidated["password"] = Crypt::encrypt($resultValidated["password"]);
        $resultValidated["password"] = Hash::make($resultValidated["password"]);
        // $resultValidated["password"] = bcrypt($resultValidated["password"]);

        User::create($resultValidated);

        return redirect("/login")->with("registered", "Success on register, now please login!");
    }
}
