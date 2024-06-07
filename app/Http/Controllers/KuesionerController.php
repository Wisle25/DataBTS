<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kuesioners = Kuesioner::all();
        return view('kuesioner.index', compact('kuesioners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kuesioner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'pertanyaan' => 'required|string',
        // ]);

        Kuesioner::create([
            'pertanyaan' => $request->pertanyaan,
            // 'created_by' => Auth::id(),
            // 'edited_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Kuesioner created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kuesioner $kuesioner)
    {
        return view('kuesioner.edit', compact('kuesioner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kuesioner $kuesioner)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
        ]);

        $kuesioner->update([
            'pertanyaan' => $request->pertanyaan,
            // 'edited_by' => Auth::id(),
            'edited_at' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Kuesioner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kuesioner $kuesioner)
    {
        $kuesioner->delete();

        return redirect()->route('dashboard')->with('success', 'Kuesioner deleted successfully.');
    }
}
