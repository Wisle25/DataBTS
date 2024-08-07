<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BTSController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\JenisBTSController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\MonitoringController;
use Illuminate\Support\Facades\Auth;

/* *
 * Main Pages 
 * */
Route::get("/", [HomeController::class, "home"])->name('home');


/* *
 * User
 * */
Route::controller(UserController::class)->group(function () {
    Route::get("/login", function () {
        if (!Auth::check()) {
            return view("pages.auth.login");
        } else {
            return redirect('/');
        };
    })->name("login");

    Route::get("/register", function () {
        if (!Auth::check()) {
            return view("pages.auth.register");
        } else {
            return redirect('/');
        };
    })->name("register");
    
    Route::post("/user", "register");
    Route::post("/auth", "login");
    Route::get("/profile", "profile")->middleware("auth")->name("profile");
    Route::get("/profile/edit", "editProfile")->name("profile.edit");
    Route::put("/profile/update", "updateProfile")->name("profile.update");
    Route::delete("/profile", "deleteProfile")->name("profile.delete");
    Route::delete("/auth", "logout")->name("auth.logout");
});

Route::get('/unauthorized', function () {
    return view('pages.unauthorized');
})->name('unauthorized');


//Dashboard
Route::controller(DashboardController::class)->group(function () {
    Route::get("/dashboard", "index")->name("dashboard");
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
    Route::get('/kuesioner/{kuesioner}', 'show')->name('kuesioner.show');
    Route::post("/kuesioner", "store")->name("kuesioner.store");
    Route::post('/kuesioner/{answer}/mark-as-best', 'markAsBest')->name('kuesioner.markAsBest');
    Route::post('/kuesioner/{kuesioner}/answer', 'storeAnswer')->name('kuesioner.jawaban.store');
    Route::get("/kuesioner/{kuesioner}/edit", "edit")->name("kuesioner.edit");
    Route::put("/kuesioner/{kuesioner}", "update")->name('kuesioner.update');
    Route::delete("/kuesioner/{kuesioner}", "destroy")->name("kuesioner.destroy");
    Route::put('/kuesioner/jawaban/{kuesionerJawaban}', 'updateAnswer')->name('kuesioner.jawaban.update');
    Route::delete('/kuesioner/jawaban/{kuesionerJawaban}', 'destroyAnswer')->name('kuesioner.jawaban.destroy');
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

// Pengguna
Route::controller(PenggunaController::class)->group(function () {
    Route::get("/pengguna", "index")->name('pengguna.index');
    Route::get("/pengguna/create", "create")->name('pengguna.create');
    Route::post("/pengguna", "store")->name('pengguna.store');
    Route::get("/pengguna/{pengguna}/edit", "edit")->name("pengguna.edit");
    Route::put("/pengguna/{pengguna}", "update")->name('pengguna.update');
    Route::delete("/pengguna/{pengguna}", "destroy")->name('pengguna.destroy');
    Route::get("/pengguna/export/excel", "export_excel")->name('pengguna.exportExcel');
    Route::get("/pengguna/export/pdf", "exportPdf")->name('pengguna.exportPdf');
    Route::get('/pengguna/{id}/log' ,'log')->name('pengguna.log');
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
