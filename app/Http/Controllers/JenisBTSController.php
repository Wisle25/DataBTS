<?php

namespace App\Http\Controllers;

use App\Models\JenisBTS;
use Illuminate\Http\Request;

class JenisBTSController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisBTS = JenisBTS::all();
        return view('pages.jenis_bts.index', compact('jenisBTS'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jenis_bts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        JenisBTS::create([
            'nama' => $request->nama,
            // 'created_by' => Auth::id(),
            // 'edited_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Jenis BTS created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisBTS $jenisBTS)
    {
        return view('pages.jenis_bts.edit', compact('jenisBTS'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisBTS $jenisBTS)
    {
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        // ]);

        $jenisBTS->update([
            'nama' => $request->nama,
            // 'edited_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Jenis BTS updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisBTS $jenisBTS)
    {
        $jenisBTS->delete();
        return redirect()->route('dashboard')->with('success', 'Jenis BTS deleted successfully.');
    }
}
