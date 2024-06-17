<?php

namespace App\Http\Controllers;

use App\Models\JenisBTS;
use App\Models\Kuesioner;
use App\Models\Monitoring;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $max_data = 5;
        $pemilik = Pemilik::orderBy('name', 'asc')->paginate($max_data, ['*'], 'pemilik_page')->withQueryString();
        $jenis_bts = JenisBTS::orderBy('nama', 'asc')->paginate($max_data, ['*'], 'jenis_bts_page')->withQueryString();
        $kuesioner = Kuesioner::orderBy('created_at', 'asc')->paginate($max_data, ['*'], 'kuesioner_page')->withQueryString();

        return view('pages.dashboard', compact("pemilik", "jenis_bts", "kuesioner"));
    }
}
