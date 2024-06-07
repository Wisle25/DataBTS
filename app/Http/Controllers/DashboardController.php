<?php

namespace App\Http\Controllers;

use App\Models\JenisBTS;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function createPemilik()
    {
        return view('pages.pemilik.create');
    }

    public function index() {
        $pemilik = Pemilik::all();
        $jenis_bts = JenisBTS::all();
        return view('pages.dashboard', compact("pemilik", "jenis_bts"));
    }
}