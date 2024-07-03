<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\ExportPengguna;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class PenggunaController extends Controller
{
    public function index()
    {
        $max_data = 8;

        if (request('search')) {
            $pengguna = Pengguna::where('nama', 'like', '%' . request('search') . '%')->paginate($max_data);
        } else {
            $pengguna = Pengguna::orderBy('nama', 'asc')->paginate($max_data);
        }
        return view('pages.pengguna.index', compact('pengguna'));
    }


    public function export_excel()
    {
        return Excel::download(new ExportPengguna, "Pengguna.xlsx");
    }

    public function create()
    {
        return view('pages.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pengguna',
            'password' => 'required|string|min:8',
            'email' => 'required|email|max:255|unique:pengguna',
            'peran' => 'required|in:Administrator,User,PIC,Surveyor',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'peran' => $request->peran,
            'status' => 'aktif',
            // 'created_by' => /* Auth::id() */ 1,
            // 'edited_by' => /* Auth::id() */ 1,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna created successfully.');
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna deleted successfully.');
    }

    public function exportPdf()
    {
        $pengguna = Pengguna::orderBy('nama', 'asc')->get();

        $mpdf = new Mpdf();

        $html = view('pages.pengguna.exportPdf', compact('pengguna'))->render();

        $mpdf->WriteHTML($html);

        $pdfOutput = $mpdf->Output('Pengguna.pdf', 'S'); // S: return as a string

        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Pengguna.pdf"')
            ->header('Cache-Control', 'private, max-age=0, must-revalidate')
            ->header('Pragma', 'public');
    }

    public function show($id)
    {
        $pengguna = Pengguna::findOrFail($id);

        return view('pages.pengguna.show', compact('pengguna'));
    }
}
