<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Pages
Route::get("/", function () {
    return view("pages.home");
});

// User
Route::controller(UserController::class)->group(function () {
    Route::get("/login", function () {
        return view("pages.auth.login");
    })->name("login");
    
    Route::get("/register", function () {
        return view("pages.auth.register");
    })->name("register");

    Route::post("/user", "register");
    Route::post("/auth", "login");
});
