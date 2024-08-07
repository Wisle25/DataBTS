<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\BTS;
use App\Exports\ExportBTS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BTSController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $max_data = 8;

            if (request('search')) {
                $data = BTS::where('nama', 'like', '%' . request('search') . '%')->paginate($max_data);
            } else {
                $data = BTS::orderBy('nama', 'asc')->paginate($max_data);
            }

            $allBTSData = BTS::select('id', 'nama', 'alamat', 'latitude', 'longitude', 'tinggi_tower')->get();

            return view("pages.bts.index", compact("data", "allBTSData"));
        } else {
            return redirect('/login');
        }
    }

    public function export_excel()
    {
        return Excel::download(new ExportBTS, "BTS.xlsx");
    }

    public function create()
    {
        return view('pages.bts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'path_foto' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'tinggi_tower' => 'required|integer',
            'panjang_tanah' => 'required|integer',
            'lebar_tanah' => 'required|integer',
            'ada_genset' => 'required|boolean',
            'ada_tembok_batas' => 'required|boolean',
            'id_pemilik' => 'required|exists:pemilik,id',
            'id_wilayah' => 'required|exists:wilayah,id',
            'id_jenis_bts' => 'required|exists:jenis_bts,id'
        ]);

        $foto_file = $request->file('path_foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
        $foto_file->move(public_path('path_foto'), $foto_nama);


        BTS::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tinggi_tower' => $request->tinggi_tower,
            'panjang_tanah' => $request->panjang_tanah,
            'lebar_tanah' => $request->lebar_tanah,
            'ada_genset' => $request->ada_genset,
            'ada_tembok_batas' => $request->ada_tembok_batas,
            'id_pemilik' => $request->id_pemilik,
            'id_user' => Auth::user()->id,
            'id_wilayah' => $request->id_wilayah,
            'id_jenis_bts' => $request->id_jenis_bts,
            'path_foto' => $foto_nama,
            'created_by' => Auth::user()->username,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('bts.index')->with('success', 'BTS created successfully.');
    }


    public function edit(BTS $bts)
    {
        return view('pages.bts.edit', compact('bts'));
    }

    public function update(Request $request, BTS $bts)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'path_foto' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'tinggi_tower' => 'required|integer',
            'panjang_tanah' => 'required|integer',
            'lebar_tanah' => 'required|integer',
            'ada_genset' => 'required|boolean',
            'ada_tembok_batas' => 'required|boolean',
        ]);

        if ($request->hasFile('path_foto')) {
            // Hapus file lama jika ada
            if ($bts->path_foto && file_exists(public_path('path_foto/' . $bts->path_foto))) {
                unlink(public_path('path_foto/' . $bts->path_foto));
            }

            $foto_file = $request->file('path_foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('path_foto'), $foto_nama);
        } else {
            $foto_nama = $bts->path_foto; // Gunakan foto lama jika tidak ada file baru
        }

        $bts->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'path_foto' => $foto_nama,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tinggi_tower' => $request->tinggi_tower,
            'panjang_tanah' => $request->panjang_tanah,
            'lebar_tanah' => $request->lebar_tanah,
            'ada_genset' => $request->ada_genset,
            'ada_tembok_batas' => $request->ada_tembok_batas,
            'edited_by' => Auth::user()->username,
            'updated_at' => now()
        ]);

        return redirect()->route('bts.index')->with('success', 'BTS updated successfully.');
    }

    public function destroy(BTS $bts)
    {
        if ($bts->path_foto && file_exists(public_path('path_foto/' . $bts->path_foto))) {
            unlink(public_path('path_foto/' . $bts->path_foto));
        }
        $bts->delete();
        return redirect()->route('bts.index')->with('success', 'BTS deleted successfully.');
    }

    public function exportPdf()
    {
        $data = BTS::orderBy('nama', 'asc')->get();
        $mpdf = new Mpdf();
        $html = view('pages.bts.exportPdf', compact('data'))->render();
        $mpdf->WriteHTML($html);
        $pdfOutput = $mpdf->Output('BTS.pdf', 'S'); // S: return as a string

        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="BTS.pdf"')
            ->header('Cache-Control', 'private, max-age=0, must-revalidate')
            ->header('Pragma', 'public');
    }
}
