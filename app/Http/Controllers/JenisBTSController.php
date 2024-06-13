<?php

namespace App\Http\Controllers;

use App\Models\JenisBTS;
use Illuminate\Http\Request;

class JenisBTSController extends Controller
{
    public function index()
    {
        $jenisBTS = JenisBTS::all();
        return view('pages.jenis_bts.index', compact('jenisBTS'));
    }

    public function create()
    {
        return view('pages.jenis_bts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        JenisBTS::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('dashboard')->with('success', 'Jenis BTS created successfully.');
    }

    public function edit(JenisBTS $jenisBTS)
    {
        return view('pages.jenis_bts.edit', compact('jenisBTS'));
    }

    public function update(Request $request, JenisBTS $jenisBTS)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $jenisBTS->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('dashboard')->with('success', 'Jenis BTS updated successfully.');
    }

    public function destroy(JenisBTS $jenisBTS)
    {
        $jenisBTS->delete();
        return redirect()->route('dashboard')->with('success', 'Jenis BTS deleted successfully.');
    }
}
