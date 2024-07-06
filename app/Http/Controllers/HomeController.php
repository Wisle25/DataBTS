<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BTS;
use App\Models\Pengguna;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            $totalBTS = BTS::count();
            $totalJenisBTS = BTS::distinct('id_jenis_bts')->count('id_jenis_bts');
            $totalPemilikBTS = BTS::distinct('id_pemilik')->count('id_pemilik');
            $totalPIC = Pengguna::where('peran', 'PIC')->count();
            $totalSurveyor = Pengguna::where('peran', 'Surveyor')->count();


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

            // Hitung total BTS yang sudah dimonitoring
            $totalMonitored = $normalCount + $faultCount + $maintenanceCount + $offlineCount;

            // Hitung BTS yang belum dimonitoring (notyet)
            $notYetMonitored = $totalBTS - $totalMonitored;

            return view('pages.home', compact('totalBTS', 'totalJenisBTS', 'totalPemilikBTS', 'normalCount', 'faultCount', 'maintenanceCount', 'offlineCount', 'totalPIC', 'totalSurveyor','notYetMonitored'));
        } else {
            return redirect('/login');
        }
    }
}
