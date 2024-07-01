<?php

use App\Http\Controllers\BTSController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBTSController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdministrator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WilayahController;

/* *
 * Main Pages 
 * */
Route::get("/", function () {
    return view("pages.home");
})->name("home");

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
    Route::get("/profile", "profile")->middleware("auth")->name("profile");
    Route::get("/profile/edit", "editProfile")->name("profile.edit");
    Route::put("/profile/update","updateProfile")->name("profile.update");
    Route::delete("/profile","deleteProfile")->name("profile.delete");
});

// BTS
Route::controller(BTSController::class)->group(function () {
    Route::get("/bts", "index")->name("bts.index");
    Route::get("/bts/create", "create")->name("bts.create");
    Route::post("/bts", "store")->name("bts.store");
    Route::get("/bts/{bts}/edit", "edit")->name("bts.edit");
    Route::put("/bts/{bts}", "update")->name('bts.update');
    Route::delete("/bts/{bts}", "destroy")->name("bts.destroy");
    Route::get("/bts/export/excel", "export_excel")->name('bts.exportExcel');
    Route::get("/bts/export/pdf", "exportPdf")->name('bts.exportPdf');
});



// Wilayah
Route::controller(WilayahController::class)->group(function () {
    Route::get("/wilayah", "index")->name("wilayah.index");
    Route::get("/wilayah/create", "create")->name("wilayah.create");
    Route::post("/wilayah", "store")->name("wilayah.store");
    Route::get("/wilayah/{wilayah}/edit", "edit")->name("wilayah.edit");
    Route::put("/wilayah/{wilayah}", "update")->name('wilayah.update');
    Route::delete("/wilayah/{wilayah}", "destroy")->name("wilayah.destroy");
    Route::get('/wilayah/export/excel', "export_excel")->name('wilayah.exportExcel');
    Route::get("/wilayah/export/pdf", "exportPdf")->name('wilayah.exportPdf');
});

// Pemilik
Route::controller(PemilikController::class)->group(function () {
    Route::get("/pemilik", "index")->name('pemilik.index');
    Route::get("/pemilik/create", "create")->name('pemilik.create');
    Route::post("/pemilik", "store")->name('pemilik.store');
    Route::get("/pemilik/{pemilik}/edit", "edit")->name('pemilik.edit');
    Route::put("/pemilik/{pemilik}", "update")->name('pemilik.update');
    Route::delete("/pemilik/{pemilik}", "destroy")->name('pemilik.destroy');
    Route::get("/pemilik/export/excel", "export_excel")->name('pemilik.exportExcel');
    Route::get("/pemilik/export/pdf", "exportPdf")->name('pemilik.exportPdf');
    Route::get('/pemilik/{id}', 'show')->name('pemilik.show');
});

// JenisBTS
Route::controller(JenisBTSController::class)->group(function () {
    Route::get("/jenis_bts", "index")->name("jenis_bts.index");
    Route::get("/jenis_bts/create", "create")->name("jenis_bts.create");
    Route::post("/jenis_bts", "store")->name("jenis_bts.store");
    Route::get("/jenis_bts/{jenis_bts}/edit", "edit")->name("jenis_bts.edit");
    Route::put("/jenis_bts/{jenis_bts}", "update")->name('jenis_bts.update');
    Route::delete("/jenis_bts/{jenis_bts}", "destroy")->name("jenis_bts.destroy");
    Route::get("/jenis_bts/export/excel", "export_excel")->name('jenis_bts.exportExcel');
    Route::get("/jenis_bts/export/pdf", "exportPdf")->name('jenis_bts.exportPdf');
    Route::get('/jenis_bts/{id}', 'show')->name('jenis_bts.show');

});

// Kuesioner
Route::controller(KuesionerController::class)->group(function () {
    Route::get("/kuesioner", "index")->name("kuesioner.index");
    Route::get("/kuesioner/create", "create")->name("kuesioner.create");
    Route::post("/kuesioner", "store")->name("kuesioner.store");
    Route::get("/kuesioner/{kuesioner}/edit", "edit")->name("kuesioner.edit");
    Route::put("/kuesioner/{kuesioner}", "update")->name('kuesioner.update');
    Route::delete("/kuesioner/{kuesioner}", "destroy")->name("kuesioner.destroy");
    Route::get("/kuesioner/export/excel", "export_excel")->name('kuesioner.exportExcel');
    Route::get("/kuesioner/export/pdf", "exportPdf")->name('kuesioner.exportPdf');
});

// Monitoring
Route::controller(MonitoringController::class)->group(function () {
    Route::get("/monitoring", "index")->name("monitoring.index");
    Route::get("/monitoring/create", "create")->name("monitoring.create");
    Route::post("/monitoring", "store")->name("monitoring.store");
    Route::get("/monitoring/{monitoring}/edit", "edit")->name("monitoring.edit");
    Route::put("/monitoring/{monitoring}", "update")->name('monitoring.update');
    Route::delete("/monitoring/{monitoring}", "destroy")->name("monitoring.destroy");
    Route::get("/monitoring/export/excel", "export_excel")->name('monitoring.exportExcel');
    Route::get("/monitoring/export/pdf", "exportPdf")->name('monitoring.exportPdf');
});



// Route::get('/wilayah', function () {
//     return view('pages.wilayah.index');
// });
// Route::get('/wilayah/edit', function () {
//     return view('pages.wilayah.edit');
// });
// Route::get('/wilayah/create', function () {
//     return view('pages.wilayah.create');
// });
