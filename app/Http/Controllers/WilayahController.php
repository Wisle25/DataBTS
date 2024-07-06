<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use App\Exports\ExportWilayah;
use Maatwebsite\Excel\Facades\Excel;

class WilayahController extends Controller
{
    public function index()
    {

        $data = Wilayah::with('children')->orderBy('id_parent', 'asc')->get();

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

        return redirect()->route('dashboard')->with('success', 'Wilayah berhasil dibuat.');
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

        return redirect()->route('dashboard')->with('success', 'Wilayah berhasil diupdate.');
    }

    // Hapus wilayah
    public function destroy(Wilayah $wilayah)
    {
        $wilayah->delete();

        return redirect()->route('dashboard')->with('success', 'Wilayah berhasil dihapus.');
    }

    public function exportPdf()
    {
        // Ambil data dari database
        $wilayahs = Wilayah::with('children')->orderBy('id_parent', 'asc')->get();

        // Inisialisasi mPDF
        $mpdf = new Mpdf();

        // Buat tampilan untuk PDF
        $html = view('pages.wilayah.exportPdf', compact('wilayahs'))->render();

        // Menulis HTML ke PDF
        $mpdf->WriteHTML($html);

        // Output PDF untuk diunduh
        $pdfOutput = $mpdf->Output('Wilayah.pdf', 'S'); // S: return as a string

        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Wilayah.pdf"')
            ->header('Cache-Control', 'private, max-age=0, must-revalidate')
            ->header('Pragma', 'public');
    }
}
