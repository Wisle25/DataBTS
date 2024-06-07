<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitorings = Monitoring::all();
        return view('pages.monitoring.index', compact('monitorings'));
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
        // $request->validate([
        //     'tahun' => 'required|integer',
        //     'id_bts' => 'nullable|integer',
        //     'tisi_bts' => 'required|string',
        //     'id_user_surveyor' => 'nullable|integer',
        // ]);

        Monitoring::create([
            'tahun' => $request->tahun,
            'id_bts' => $request->id_bts,
            'tisi_bts' => $request->tisi_bts,
            'id_user_surveyor' => $request->id_user_surveyor,
            // 'created_by' => Auth::id(),
            // 'edited_by' => Auth::id(),
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
        // $request->validate([
        //     'tahun' => 'required|integer',
        //     'id_bts' => 'nullable|integer',
        //     'tisi_bts' => 'required|string',
        //     'id_user_surveyor' => 'nullable|integer',
        // ]);

        $monitoring->update([
            'tahun' => $request->tahun,
            'id_bts' => $request->id_bts,
            'tisi_bts' => $request->tisi_bts,
            'id_user_surveyor' => $request->id_user_surveyor,
            // 'edited_by' => Auth::id(),
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
