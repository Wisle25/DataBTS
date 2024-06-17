<?php

namespace App\Http\Controllers;

use App\Exports\ExportMonitoring;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 8;
        
        if (request('search')) {
            $monitorings = Monitoring::where('id_bts', 'like', '%' . request('search') . '%')->paginate($max_data);
        } else {
            $monitorings = Monitoring::orderBy('tahun', 'asc')->paginate($max_data);
        }

        return view('pages.monitoring.index', compact('monitorings'));
    }

    public function export_excel()
    {
        return Excel::download(new ExportMonitoring, "Monitoring.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.monitoring.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'id_bts' => 'required|integer',
            'tgl_generate' => 'required|date',
            'tgl_kunjungan' => 'required|date',
            'kondisi_bts' => 'required|in:Active,Not Active', // Validasi kondisi_bts
            'id_user_surveyor' => 'nullable|integer',
            'created_by' => 'nullable|integer',
            'edited_by' => 'nullable|integer',
        ]);

        Monitoring::create([
            'tahun' => $request->tahun,
            'id_bts' => $request->id_bts,
            'tgl_generate' => $request->tgl_generate,
            'tgl_kunjungan' => $request->tgl_kunjungan,
            'kondisi_bts' => $request->kondisi_bts, // Simpan kondisi_bts sesuai input
            'edited_at' => now()
        ]);

        return redirect()->route('monitoring.index')->with('success', 'Monitoring created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Monitoring $monitoring)
    {
        return view('pages.monitoring.edit', compact('monitoring'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monitoring $monitoring)
    {
        $request->validate([
            'tahun' => 'required|date_format:Y',
            'id_bts' => 'required|exists:bts,id',
            'tgl_generate' => 'required|date',
            'tgl_kunjungan' => 'required|date',
            'kondisi_bts' => 'required|in:Active,Not Active', // Validasi kondisi_bts
            'id_user_surveyor' => 'nullable|exists:users,id',
        ]);

        $monitoring->update([
            'tahun' => $request->tahun,
            'id_bts' => $request->id_bts,
            'tgl_generate' => $request->tgl_generate,
            'tgl_kunjungan' => $request->tgl_kunjungan,
            'kondisi_bts' => $request->kondisi_bts, // Simpan kondisi_bts sesuai input
            'edited_at' => now()
        ]);

        return redirect()->route('monitoring.index')->with('success', 'Monitoring updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitoring $monitoring)
    {
        $monitoring->delete();
        return redirect()->route('monitoring.index')->with('success', 'Monitoring deleted successfully.');
    }
}
