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


Route::get('/login', function () {
    return view('pages.auth.login');
});
Route::get('/register', function () {
    return view('pages.auth.register');
});
Route::get('/bts', function () {
    return view('pages.bts.index');
});
Route::get('/bts/edit', function () {
    return view('pages.bts.edit');
});
Route::get('/bts/create', function () {
    return view('pages.bts.create');
});


Route::get('/wilayah', function () {
    return view('pages.wilayah.index');
});
Route::get('/wilayah/edit', function () {
    return view('pages.wilayah.edit');
});
Route::get('/wilayah/create', function () {
    return view('pages.wilayah.create');
});
Route::get('/monitoring', function () {
    return view('pages.monitoring.index');
});
Route::get('/monitoring/edit', function () {
    return view('pages.monitoring.edit');
});
Route::get('/monitoring/create', function () {
    return view('pages.monitoring.create');
});
Route::get('/kuesioner', function () {
    return view('pages.kuesioner.index');
});
Route::get('/kuesioner/create', function () {
    return view('pages.kuesioner.create');
});
Route::get('/kuesioner/edit', function () {
    return view('pages.kuesioner.edit');
});
