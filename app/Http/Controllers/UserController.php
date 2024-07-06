<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UserLog;
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
            "nama" => $request->nama,
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "peran" => 'User'
        ]);

        return redirect()->route("login")->with("success", "Berhasil membuat akun!");
    }

    public function profile() {
        $user = Auth::user();

        return view("pages.profile.index", compact("user"));
    }

    public function editProfile() {
        $user = Auth::user();

        return view('pages.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pengguna,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:pengguna,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function deleteProfile()
    {
        $user = Auth::user();
        Auth::logout();

        $user->delete();

        return redirect('/')->with('success', 'Profile deleted successfully.');
    }

    public function login(Request $request)
    {
        // Validate
        // $validator = Validator::make($request->all(), [
        //     "email" => "required|string|email|max:255|unique:pengguna",
        //     "password" => "required|string|min:8"
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Retrieve only 'username' and 'password' from the request
        $credentials = $request->only('email', 'password');

        // Attempt to log in with the provided credentials
        if (auth()->attempt($credentials)) {
            UserLog::create([
                'id_user' => auth()->user()->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'login_at' => now()->timezone('Asia/Jakarta'), 
            ]);
            return redirect()->intended('/');
        }

        // Redirect back with an error message if login fails
        return redirect()->back()->withErrors(['username' => 'Invalid credentials'])->withInput(["email"]);
    }

    public function logout() {
        auth()->logout();

        return redirect()->route("home")->with("success", "Successfully logout!");
    }
}
