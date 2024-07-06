<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use App\Models\Wilayah;
use App\Models\JenisBTS;
use App\Models\Kuesioner;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->peran == 'Administrator' || Auth::user()->peran == 'PIC') {
                $max_data = 5;
                $pemilik = Pemilik::orderBy('name', 'asc')->paginate($max_data, ['*'], 'pemilik_page')->withQueryString();
                $jenis_bts = JenisBTS::orderBy('nama', 'asc')->paginate($max_data, ['*'], 'jenis_bts_page')->withQueryString();
                $data = Wilayah::orderBy('id_parent', 'asc')->paginate($max_data, ['*'], 'wilayah_page')->withQueryString();

                return view('pages.dashboard', compact("pemilik", "jenis_bts", "data"));
            } else {
                return redirect('/unauthorized')->with('error', 'Anda tidak memiliki hak akses untuk halaman ini.');
            }
        } else {
            return redirect('/login');
        }
    }
}
