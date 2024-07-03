<?php

namespace App\Http\Controllers;

use App\Exports\ExportKuesioner;
use Auth;
use App\Models\Kuesioner;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class KuesionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 5; // Number of items per page
        $kuesioners = Kuesioner::where('created_by', Auth::id())
            ->orderBy('created_at', 'asc')
            ->paginate($max_data)
            ->withQueryString();
            
        return view('pages.kuesioner.index', compact('kuesioners'));
    }


    public function export_excel(){
        return Excel::download(new ExportKuesioner, "Kuesioner.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kuesioner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subjek' => 'required|string|max:50',
            'pertanyaan' => 'required|string',
        ]);

        Kuesioner::create([
            'subjek' => $request->subjek,
            'pertanyaan' => $request->pertanyaan,
            'created_by' => Auth::id(),
            'edited_by' => Auth::id(),
            'updated_at' => now()
        ]);

        return redirect()->route('kuesioner.index')->with('success', 'Kuesioner created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kuesioner $kuesioner)
    {
        return view('pages.kuesioner.edit', compact('kuesioner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kuesioner $kuesioner)
    {
        $request->validate([
            'subjek' => "required|string|max:50",
            'pertanyaan' => 'required|string',
        ]);

        $kuesioner->update([
            'subjek' => $request->subjek,
            'pertanyaan' => $request->pertanyaan,
            'edited_by' => Auth::id(),
            'edited_at' => now()
        ]);

        return redirect()->route('kuesioner.index')->with('success', 'Kuesioner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kuesioner $kuesioner)
    {
        $kuesioner->delete();

        return redirect()->route('kuesioner.index')->with('success', 'Kuesioner deleted successfully.');
    }

    public function exportPdf()
    {
        // Ambil data dari database
        $kuesioners = Kuesioner::orderBy('created_at', 'asc')->get();

        // Inisialisasi mPDF
        $mpdf = new Mpdf();

        // Buat tampilan untuk PDF
        $html = view('pages.kuesioner.exportPdf', compact('kuesioners'))->render();

        // Menulis HTML ke PDF
        $mpdf->WriteHTML($html);

        // Output PDF untuk diunduh
        $pdfOutput = $mpdf->Output('Kuesioner.pdf', 'S'); // S: return as a string

        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Kuesioner.pdf"')
            ->header('Cache-Control', 'private, max-age=0, must-revalidate')
            ->header('Pragma', 'public');
    }

}
