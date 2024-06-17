<?php

namespace App\Http\Controllers;

use App\Exports\ExportWilayah;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WilayahController extends Controller
{
    public function index()
    {
        $max_data = 8;

        if (request('search')) {
            $data = Wilayah::where('nama', 'like', '%' . request('search') . '%')->paginate($max_data);
        } else {
            $data = Wilayah::with('children')->orderBy('id_parent', 'asc')->paginate($max_data);
        }

        return view('pages.wilayah.index', compact('data'));
    }

    public function export_excel()
    {
        return Excel::download(new ExportWilayah, "Wilayah.xlsx");
    }

    public function create()
    {
        $dataInduk = Wilayah::whereNull('id_parent')->get();
        return view('pages.wilayah.create', compact('dataInduk'));
    }

    // Simpan wilayah baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_parent' => 'nullable|exists:wilayah,id',
            'level' => 'required|integer',
        ]);

        Wilayah::create([
            'nama' => $request->nama,
            'id_parent' => $request->id_parent,
            'level' => $request->level,
        ]);

        return redirect()->route('wilayah.index')->with('success', 'Wilayah berhasil dibuat.');
    }

    // Tampilkan form untuk mengedit wilayah
    public function edit(Wilayah $wilayah)
    {
        $wilayahInduk = Wilayah::whereNull('id_parent')->get();
        return view('pages.wilayah.edit', compact('wilayah', 'wilayahInduk'));
    }

    // Update wilayah
    public function update(Request $request, Wilayah $wilayah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_parent' => 'nullable|exists:wilayah,id',
            'level' => 'required|integer',
        ]);

        $wilayah->update([
            'nama' => $request->nama,
            'id_parent' => $request->id_parent,
            'level' => $request->level,
        ]);

        return redirect()->route('wilayah.index')->with('success', 'Wilayah berhasil diupdate.');
    }

    // Hapus wilayah
    public function destroy(Wilayah $wilayah)
    {
        $wilayah->delete();

        return redirect()->route('wilayah.index')->with('success', 'Wilayah berhasil dihapus.');
    }
}
