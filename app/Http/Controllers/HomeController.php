<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Monitoring;
use App\Models\BTS;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // Logika untuk data BTS
        $totalBTS = BTS::count();
        $totalJenisBTS = BTS::distinct('id_jenis_bts')->count('id_jenis_bts');
        $totalPemilikBTS = BTS::distinct('id_pemilik')->count('id_pemilik');

        // Mendapatkan tahun dan bulan saat ini
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Menghitung jumlah kondisi BTS pada bulan ini
        $normalCount = Monitoring::whereYear('tgl_generate', $currentYear)
            ->whereMonth('tgl_generate', $currentMonth)
            ->where('id_kondisi_bts', 1)
            ->count();

        $faultCount = Monitoring::whereYear('tgl_generate', $currentYear)
            ->whereMonth('tgl_generate', $currentMonth)
            ->where('id_kondisi_bts', 2)
            ->count();

        $maintenanceCount = Monitoring::whereYear('tgl_generate', $currentYear)
            ->whereMonth('tgl_generate', $currentMonth)
            ->where('id_kondisi_bts', 3)
            ->count();

        $offlineCount = Monitoring::whereYear('tgl_generate', $currentYear)
            ->whereMonth('tgl_generate', $currentMonth)
            ->where('id_kondisi_bts', 4)
            ->count();

        // Mengirimkan data ke view
        return view('pages.home', compact('totalBTS', 'totalJenisBTS', 'totalPemilikBTS', 'normalCount', 'faultCount', 'maintenanceCount', 'offlineCount'));
    }
}
