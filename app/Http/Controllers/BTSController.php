<?php

namespace App\Http\Controllers;

use App\Models\BTS;
use App\Exports\ExportBTS;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class BTSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 8;

        if (request('search')) {
            $data = BTS::where('nama', 'like', '%' . request('search') . '%')->paginate($max_data);
        } else {
            $data = BTS::orderBy('nama', 'asc')->paginate($max_data);
        }

        $allBTSData = BTS::select('id', 'nama', 'alamat', 'latitude', 'longitude', 'tinggi_tower')->get();

        return view("pages.bts.index", compact("data", "allBTSData"));
    }

    public function export_excel(){
        return Excel::download(new ExportBTS, "BTS.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.bts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
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
            // 'id_user_pic' => 'nullable|integer',
        ]);

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
            'id_wilayah' => $request->id_wilayah,
            'id_jenis_bts' => $request->id_jenis_bts,
            // 'id_user_pic' => $request->id_user_pic,
            // 'created_by' => Auth::id(),
            // 'edited_by' => Auth::id(),
            'edited_at' => now()
        ]);

        return redirect()->route('bts.index')->with('success', 'BTS created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BTS $bts)
    {
        return view('pages.bts.edit', compact('bts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BTS $bts)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            // 'id_jenis_bts' => 'nullable|integer',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'tinggi_tower' => 'required|integer',
            'panjang_tanah' => 'required|integer',
            'lebar_tanah' => 'required|integer',
            'ada_genset' => 'required|boolean',
            'ada_tembok_batas' => 'required|boolean',
            // 'id_user_pic' => 'nullable|integer',
            // 'id_pemilik' => 'nullable|integer',
            // 'id_wilayah' => 'nullable|integer',
        ]);

        $bts->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            // 'id_jenis_bts' => $request->id_jenis_bts,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tinggi_tower' => $request->tinggi_tower,
            'panjang_tanah' => $request->panjang_tanah,
            'lebar_tanah' => $request->lebar_tanah,
            'ada_genset' => $request->ada_genset,
            'ada_tembok_batas' => $request->ada_tembok_batas,
            // 'id_user_pic' => $request->id_user_pic,
            // 'id_pemilik' => $request->id_pemilik,
            // 'id_wilayah' => $request->id_wilayah,
            // 'edited_by' => Auth::id(),
            // 'edited_at' => now()
        ]);

        return redirect()->route('bts.index')->with('success', 'BTS updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BTS $bts)
    {
        $bts->delete();
        return redirect()->route('bts.index')->with('success', 'BTS deleted successfully.');
    }

    public function exportPdf()
    {
        // Ambil data dari database
        $data = BTS::orderBy('nama', 'asc')->get();

        // Inisialisasi mPDF
        $mpdf = new Mpdf();

        // Buat tampilan untuk PDF
        $html = view('pages.bts.exportPdf', compact('data'))->render();

        // Menulis HTML ke PDF
        $mpdf->WriteHTML($html);

        // Output PDF untuk diunduh
        $pdfOutput = $mpdf->Output('BTS.pdf', 'S'); // S: return as a string

        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="BTS.pdf"')
            ->header('Cache-Control', 'private, max-age=0, must-revalidate')
            ->header('Pragma', 'public');
    }
}
