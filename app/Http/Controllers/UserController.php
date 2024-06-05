<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            "username" => "required|string|min:5|regex:/^[a-zA-Z0-9]+$/|unique:pengguna",
            "email" => "required|string|email|max:255|unique:pengguna",
            "password" => "required|string|min:8|confirmed"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pengguna::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return redirect()->route("login")->with("success", "Berhasil membuat akun!");
    }

    public function login(Request $request)
    {
        // Validate
        $validator = Validator::make($request->all(), [
            "email" => "required|string|email|max:255|unique:pengguna",
            "password" => "required|string|min:8"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve only 'username' and 'password' from the request
        $credentials = $request->only('email', 'password');

        // Attempt to log in with the provided credentials
        if (auth()->attempt($credentials)) {
            return redirect()->intended('home');
        }

        // Redirect back with an error message if login fails
        return redirect()->back()->withErrors(['username' => 'Invalid credentials'])->withInput(["email"]);
    }

    public function logout() {
        auth()->logout();

        return redirect()->route("home")->with("success", "Successfully logout!");
    }
}
