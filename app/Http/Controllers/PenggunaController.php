<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\UserLog;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Exports\ExportPengguna;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class PenggunaController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->peran == "Administrator") {
                $max_data = 8;
                $pengguna = null;
                $logs = null;

                if (request('search')) {
                    $pengguna = Pengguna::where('nama', 'like', '%' . request('search') . '%')
                    ->orderBy('peran', 'asc')
                    ->orderBy('nama', 'asc')
                    ->paginate($max_data);
                } else {
                    $pengguna = Pengguna::orderBy('peran', 'asc')->orderBy('nama', 'asc')->paginate($max_data);
                }

                // Prepare logs for each user if there's no search
                if (!request('search')) {
                    $penggunaIds = $pengguna->pluck('id')->toArray();
                    $logs = UserLog::whereIn('id_user', $penggunaIds)
                        ->orderByDesc('login_at')
                        ->get()
                        ->groupBy('id_user');
                }

                return view('pages.pengguna.index', compact('pengguna', 'logs'));
            } else {
                return redirect('/unauthorized')->with('error', 'Anda tidak memiliki hak akses untuk halaman ini.');
            }
        } else {
            return redirect('/login');
        }
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
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna created successfully.');
    }

    public function edit(Pengguna $pengguna)
    {
        return view('pages.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $pengguna->update([
            'peran' => $request->peran,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna updated successfully.');
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

    public function log($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $logs = UserLog::where('id_user', $id)->orderBy('login_at', 'desc')->get();

        return view('pages.pengguna.log', compact('pengguna', 'logs'));
    }
}
