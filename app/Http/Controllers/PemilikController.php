<?php

namespace App\Http\Controllers;

use Auth;
use Mpdf\Mpdf;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use App\Exports\ExportPemilik;
use Maatwebsite\Excel\Facades\Excel;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {      
        $pemilik = Pemilik::orderBy('name', 'asc')->get();

        return view('pages.pemilik.index', compact('pemilik'));
    }

    public function export_excel()
    {
        return Excel::download(new ExportPemilik, "Pemilik.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pemilik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:pemilik|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
        ]);

        Pemilik::create([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            // 'created_by' => /* Auth::id() */ 1,
            // 'edited_by' => /* Auth::id() */ 1,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pemilik created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemilik $pemilik)
    {
        return view('pages.pemilik.edit', compact('pemilik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemilik $pemilik)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:pemilik,name,' . $pemilik->id,
        //     'alamat' => 'required|string',
        //     'telepon' => 'required|string|max:15',
        // ]);

        $pemilik->update([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon
        ]);

        return redirect()->route('dashboard')->with('success', 'Pemilik updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemilik $pemilik)
    {
        $pemilik->delete();

        return redirect()->route('dashboard')->with('success', 'Pemilik deleted successfully.');
    }

    public function exportPdf()
    {
        // Ambil data dari database
        $pemilik = Pemilik::orderBy('name', 'asc')->get();

        // Inisialisasi mPDF
        $mpdf = new Mpdf();

        // Buat tampilan untuk PDF
        $html = view('pages.pemilik.exportPdf', compact('pemilik'))->render();

        // Menulis HTML ke PDF
        $mpdf->WriteHTML($html);

        // Output PDF untuk diunduh
        $pdfOutput = $mpdf->Output('Pemilik.pdf', 'S'); // S: return as a string

        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Pemilik.pdf"')
            ->header('Cache-Control', 'private, max-age=0, must-revalidate')
            ->header('Pragma', 'public');
    }
}
