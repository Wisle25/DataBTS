<?php

namespace App\Http\Controllers;

use App\Models\JenisBTS;
use Illuminate\Http\Request;
use App\Exports\ExportJenisBTS;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class JenisBTSController extends Controller
{
    public function index()
    {

        $jenisBTS = JenisBTS::with('bts')->orderBy('nama', 'asc')->get();

        return view('pages.jenis_bts.index', compact('jenisBTS'));
    }

    public function export_excel()
    {
        return Excel::download(new ExportJenisBTS, "JenisBTS.xlsx");
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

    public function exportPdf()
    {
        // Ambil data dari database
        $jenisBTS = JenisBTS::orderBy('nama', 'asc')->get();

        // Inisialisasi mPDF
        $mpdf = new Mpdf();

        // Buat tampilan untuk PDF
        $html = view('pages.jenis_bts.exportPdf', compact('jenisBTS'))->render();

        // Menulis HTML ke PDF
        $mpdf->WriteHTML($html);

        // Output PDF untuk diunduh
        $pdfOutput = $mpdf->Output('JenisBTS.pdf', 'S'); // S: return as a string

        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="JenisBTS.pdf"')
            ->header('Cache-Control', 'private, max-age=0, must-revalidate')
            ->header('Pragma', 'public');
    }

    public function show($id)
    {
        // Fetch the owner by ID with eager loading for bts
        $jenisBTS = JenisBTS::with('bts')->findOrFail($id);


        // Return the view with the owner and their BTS records
        return view('pages.jenis_bts.show', compact('jenisBTS'));
    }
}
