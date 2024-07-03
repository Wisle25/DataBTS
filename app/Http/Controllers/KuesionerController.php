<?php

namespace App\Http\Controllers;

use App\Exports\ExportKuesioner;
use App\Models\KuesionerJawaban;
use App\Models\PilihanKuesioner;
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
    public function index(Request $request)
    {
        $max_data = 5; // Number of items per page
        $query = Kuesioner::query();
        
        if ($request->has('search') && !empty($request->search)) {
            $query->where('subjek', 'like', '%' . $request->search . '%');
        }
    
        $kuesioners = $query->orderBy('created_at', 'asc')
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

    public function show(Kuesioner $kuesioner)
    {
        $kuesioner->load('creator');
        return view('pages.kuesioner.show', compact('kuesioner'));
    }

    public function storeAnswer(Request $request, Kuesioner $kuesioner)
    {
        $request->validate([
            'jawaban' => 'required|string',
        ]);
    
        KuesionerJawaban::create([
            'id_kuesioner' => $kuesioner->id,
            'jawaban' => $request->jawaban,
            'created_by' => Auth::id(),
        ]);
    
        return redirect()->route('kuesioner.show', $kuesioner->id)->with('success', 'Jawaban submitted successfully.');
    }

    public function updateAnswer(Request $request, KuesionerJawaban $kuesionerJawaban)
    {
        $request->validate([
            'jawaban' => 'required|string',
        ]);
    
        $kuesionerJawaban->update([
            'jawaban' => $request->jawaban,
            'edited_by' => Auth::id(),
            'edited_at' => now()
        ]);
    
        return redirect()->route('kuesioner.show', $kuesionerJawaban->id_kuesioner)->with('success', 'Jawaban updated successfully.');
    }

    public function destroyAnswer(KuesionerJawaban $kuesionerJawaban)
    {
        $kuesionerJawaban->delete();

        return redirect()->route('kuesioner.show', $kuesionerJawaban->id_kuesioner)->with('success', 'Jawaban deleted successfully.');
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

    public function markAsBest($id)
    {
        $answer = KuesionerJawaban::find($id);
    
        if (!$answer) {
            return redirect()->back()->with('error', 'Answer not found.');
        }
    
        $kuesioner = $answer->kuesioner;
    
        if (Auth::user()->id != $kuesioner->created_by && Auth::user()->peran != 'Administrator') {
            return redirect()->back()->with('error', 'You are not authorized to mark this answer as the best.');
        }
    
        // Remove existing best answer if it exists
        PilihanKuesioner::where('id_kuesioner', $kuesioner->id)->delete();
    
        // Mark this answer as the best
        PilihanKuesioner::create([
            'id_kuesioner' => $kuesioner->id,
            'id_kuesioner_jawaban' => $answer->id,
            'created_by' => Auth::id(),
            'edited_by' => Auth::id(),
        ]);
    
        return redirect()->route('kuesioner.show', $kuesioner->id)->with('success', 'Answer marked as the best successfully.');
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
