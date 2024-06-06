<?php

use App\Http\Controllers\BTSController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdministrator;
use Illuminate\Support\Facades\Route;

/* *
 * Main Pages 
 * */
Route::get("/", function () {
    return view("pages.home");
});

Route::controller(DashboardController::class)->group(function () {
    Route::get("/dashboard", "index")->name("dashboard");
});

/* *
 * User
 * */
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

// Route::middleware(['auth', 'checkadministrator'])->group(function () {
    Route::controller(PemilikController::class)->group(function () {
        Route::get("/pemilik", "index")->name('pemilik.index');
        Route::get("/pemilik/create", "create")->name('pemilik.create');
        Route::post("/pemilik", "store")->name('pemilik.store');
        Route::get("/pemilik/{pemilik}/edit", "edit")->name('pemilik.edit');
        Route::get("/pemilik/{pemilik}", "update")->name('pemilik.update');
        Route::delete("/pemilik/{pemilik}", "destroy")->name('pemilik.destroy');
    });
// });

// // BTS
// Route::controller(BTSController::class)->group(function () {
//     Route::get("/bts", "index");
// });

// Route::middleware(['auth', 'checkadministrator'])->group(function () {
//     Route::controller(PemilikController::class)->group(function () {
//         Route::get("/pemilik", "index")->name('pemilik.index');
//         Route::get("/pemilik/create", "create")->name('pemilik.create');
//         Route::post("/pemilik", "store")->name('pemilik.store');
//         Route::get("/pemilik/{pemilik}/edit", "edit")->name('pemilik.edit');
//         Route::put("/pemilik/{pemilik}", "update")->name('pemilik.update');
//         Route::delete("/pemilik/{pemilik}", "destroy")->name('pemilik.destroy');
//     });
// });


// /* *
//  * Form Pages
//  * */
// Route::get('/bts', function () {
//     return view('pages.bts.index');
// });
// Route::get('/bts/edit', function () {
//     return view('pages.bts.edit');
// });
// Route::get('/bts/create', function () {
//     return view('pages.bts.create');
// });


// Route::get('/wilayah', function () {
//     return view('pages.wilayah.index');
// });
// Route::get('/wilayah/edit', function () {
//     return view('pages.wilayah.edit');
// });
// Route::get('/wilayah/create', function () {
//     return view('pages.wilayah.create');
// });

// Route::get('/monitoring', function () {
//     return view('pages.monitoring.index');
// });
// Route::get('/monitoring/edit', function () {
//     return view('pages.monitoring.edit');
// });
// Route::get('/monitoring/create', function () {
//     return view('pages.monitoring.create');
// });

// Route::get('/kuesioner', function () {
//     return view('pages.kuesioner.index');
// });
// Route::get('/kuesioner/create', function () {
//     return view('pages.kuesioner.create');
// });
// Route::get('/kuesioner/edit', function () {
//     return view('pages.kuesioner.edit');
// });

// Route::get('/pemilik', function () {
//     return view('pages.pemilik.index');
// });
// Route::get('/pemilik/create', function () {
//     return view('pages.pemilik.create');
// });
// Route::get('/pemilik/edit', function () {
//     return view('pages.pemilik.edit');
// });