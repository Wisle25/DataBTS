<?php

use App\Http\Controllers\BTSController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdministrator;
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

// BTS
Route::controller(BTSController::class)->group(function () {
    Route::get("/bts", "index");
});

Route::middleware(['auth', 'checkadministrator'])->group(function () {
    Route::controller(PemilikController::class)->group(function () {
        Route::get("/pemilik", "index")->name('pemilik.index');
        Route::get("/pemilik/create", "create")->name('pemilik.create');
        Route::post("/pemilik", "store")->name('pemilik.store');
        Route::get("/pemilik/{pemilik}/edit", "edit")->name('pemilik.edit');
        Route::put("/pemilik/{pemilik}", "update")->name('pemilik.update');
        Route::delete("/pemilik/{pemilik}", "destroy")->name('pemilik.destroy');
    });
});
